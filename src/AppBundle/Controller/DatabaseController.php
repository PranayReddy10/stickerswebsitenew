<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HouseAd;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Bringing the database in line with the code, from the panel.
 *
 * <p>Every feature added here has shipped with a .sql file to run by hand, and
 * the commonest way one of them does nothing at all is that the file was never
 * run - a missing column reads as a missing feature. This asks Doctrine what it
 * expects, compares it against what is there, and offers to add what is not.
 *
 * <p>Doctrine's own mapping is the source of truth rather than a list kept here,
 * because a list would drift from the entities the first time one changed.
 */
class DatabaseController extends Controller
{
    /**
     * Statements this page is willing to run.
     *
     * <p>Only ever additive. Dropping a column or changing its type can lose
     * data, and no button that quiet should be able to; those are listed for
     * you to look at and run yourself.
     */
    private static $safe = array(
        '/^CREATE TABLE /i',
        // A column, and nothing else that ALTER ... ADD can mean. A foreign key
        // is not an addition in any useful sense: it fails on rows that already
        // break it, on a constraint of the same name, and on a column whose type
        // does not quite match - none of which this page can judge, and all of
        // which are better read than guessed at.
        '/^ALTER TABLE \S+ ADD (?!CONSTRAINT\b|FOREIGN\b|INDEX\b|KEY\b|UNIQUE\b|PRIMARY\b|FULLTEXT\b|SPATIAL\b|CHECK\b)/i',
        '/^CREATE (UNIQUE )?INDEX /i',
    );

    public function indexAction(Request $request)
    {
        $plan = $this->plan();

        $session = $request->getSession();
        $failures = $session->get('db_failures', array());
        $session->remove('db_failures');

        return $this->render('AppBundle:Database:index.html.twig', array(
            'safe' => $plan['safe'],
            'manual' => $plan['manual'],
            'failures' => $failures,
            'orphans' => $this->orphans($plan['manual']),
            'tables' => $this->tables(),
            'brokenFormats' => $this->brokenFormats(),
        ));
    }

    /** Runs the additions, one at a time, and says what happened to each. */
    public function applyAction(Request $request)
    {
        $plan = $this->plan();
        $connection = $this->getDoctrine()->getManager()->getConnection();

        $done = 0;
        $failed = array();
        foreach ($plan['safe'] as $sql) {
            try {
                $connection->executeUpdate($sql);
                $done++;
            } catch (\Exception $e) {
                // Carry on: one statement failing should not strand the rest,
                // and the ones that worked are worth keeping.
                $failed[] = array('sql' => $sql, 'why' => $this->plainly($e->getMessage()));
            }
        }

        if ($done > 0) {
            $this->addFlash('success', $done . ' change'
                . ($done == 1 ? '' : 's') . ' applied to the database.');
        }
        if (!empty($failed)) {
            $this->addFlash('error', count($failed) . ' statement'
                . (count($failed) == 1 ? '' : 's') . ' failed - see below.');
            // Kept for the page rather than crammed into a flash: five driver
            // messages in one line is a wall nobody can read.
            $request->getSession()->set('db_failures', $failed);
        }
        if ($done === 0 && empty($failed)) {
            $this->addFlash('success', 'Nothing to do - the database already matches.');
        }

        return $this->redirect($this->generateUrl('app_database_index'));
    }

    /**
     * The part of a driver message worth reading.
     *
     * <p>Doctrine wraps the driver's own text in the whole statement it was
     * running, which the page is already showing beside it.
     */
    private function plainly($message)
    {
        $at = strpos($message, 'SQLSTATE');

        return $at === false ? $message : substr($message, $at);
    }

    /**
     * Repairs ad formats stored as a label rather than a key.
     *
     * <p>Data rather than schema, so it is its own button: the dropdown used to
     * save the label, and the column is 32 characters, so what landed was half a
     * sentence that no format could match.
     */
    public function repairAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $fixed = 0;
        foreach ($em->getRepository('AppBundle:HouseAd')->findAll() as $ad) {
            $was = $ad->getFormat();
            $ad->setFormat($was);
            if ($ad->getFormat() !== $was) {
                $fixed++;
            }
        }
        $em->flush();

        // The day rows carry a copy of the format for totalling without a join.
        $em->getConnection()->executeUpdate(
            'UPDATE house_ad_stat_table s JOIN house_ad_table a ON a.id = s.ad_id'
            . ' SET s.format = a.format WHERE s.format <> a.format');

        $this->addFlash('success', $fixed === 0
            ? 'Every ad already had a proper format.'
            : $fixed . ' ad' . ($fixed == 1 ? '' : 's') . ' repaired.');

        return $this->redirect($this->generateUrl('app_database_index'));
    }

    // ---------------------------------------------------------------- inside

    /** What Doctrine would change, split into what this page will and will not run. */
    private function plan()
    {
        $em = $this->getDoctrine()->getManager();
        $safe = array();
        $manual = array();

        try {
            $tool = new SchemaTool($em);
            // Save mode: additions only. Doctrine can still suggest a type
            // change, which is why each statement is checked again below.
            $statements = $tool->getUpdateSchemaSql(
                $em->getMetadataFactory()->getAllMetadata(), true);
        } catch (\Exception $e) {
            return array('safe' => array(), 'manual' => array(
                'Could not read the database: ' . $e->getMessage()));
        }

        foreach ($statements as $sql) {
            $trimmed = trim($sql);
            $ok = false;
            foreach (self::$safe as $pattern) {
                if (preg_match($pattern, $trimmed)) {
                    $ok = true;
                    break;
                }
            }
            if ($ok) {
                $safe[] = $trimmed;
            } else {
                $manual[] = $trimmed;
            }
        }

        return array('safe' => $safe, 'manual' => $manual);
    }

    /**
     * What stands in the way of each foreign key the page will not run.
     *
     * <p>MySQL answers a foreign key it cannot create with errno 1452 and the
     * statement, which says nothing about why. Almost always the reason is
     * rows in the child table pointing at a parent row that was deleted years
     * ago, so count them: "packs_tags_table has 14 rows pointing at packs that
     * are gone" is something you can act on. The other common reason is a
     * constraint of that name already existing (errno 121), which is worth
     * saying too, because it usually means the key is already there.
     */
    private function orphans(array $manual)
    {
        $connection = $this->getDoctrine()->getManager()->getConnection();
        $out = array();

        try {
            $taken = array();
            $rows = $connection->fetchAll(
                'SELECT CONSTRAINT_NAME AS name, TABLE_NAME AS tbl'
                . ' FROM information_schema.TABLE_CONSTRAINTS'
                . ' WHERE CONSTRAINT_SCHEMA = DATABASE()'
                . " AND CONSTRAINT_TYPE = 'FOREIGN KEY'");
            foreach ($rows as $row) {
                $taken[strtolower($row['name'])] = $row['tbl'];
            }
        } catch (\Exception $e) {
            $taken = array();
        }

        foreach ($manual as $sql) {
            $found = preg_match(
                '/^ALTER TABLE (\w+) ADD CONSTRAINT (\w+) FOREIGN KEY \((\w+)\)'
                . ' REFERENCES (\w+) \((\w+)\)/i', $sql, $m);
            if (!$found) {
                // Composite keys and anything else that is not a plain
                // one-column reference: nothing useful to count.
                continue;
            }

            list(, $child, $name, $column, $parent, $parentColumn) = $m;

            $count = null;
            try {
                $count = (int) $connection->fetchColumn(
                    'SELECT COUNT(*) FROM `' . $child . '` c'
                    . ' WHERE c.`' . $column . '` IS NOT NULL'
                    . ' AND NOT EXISTS (SELECT 1 FROM `' . $parent . '` p'
                    . ' WHERE p.`' . $parentColumn . '` = c.`' . $column . '`)');
            } catch (\Exception $e) {
                // A table that is not there yet, or a column type that will not
                // compare. Either way the count is not the story.
                $count = null;
            }

            $where = isset($taken[strtolower($name)]) ? $taken[strtolower($name)] : null;

            // The other refusal, errno 150: the two columns have to be the same
            // type, down to signedness and, on a text column, the collation.
            // Nothing in the error says which pair is wrong, so compare them.
            $childType = $this->columnType($child, $column);
            $parentType = $this->columnType($parent, $parentColumn);
            $mismatch = ($childType !== null && $parentType !== null
                && strtolower($childType) !== strtolower($parentType));

            $out[] = array(
                'sql' => $sql,
                'child' => $child,
                'column' => $column,
                'parent' => $parent,
                'parentColumn' => $parentColumn,
                'count' => $count,
                'nameTakenBy' => $where,
                'childType' => $childType,
                'parentType' => $parentType,
                'mismatch' => $mismatch,
            );
        }

        return $out;
    }

    /** A column's declared type, as MySQL will compare it for a foreign key. */
    private function columnType($table, $column)
    {
        try {
            $row = $this->getDoctrine()->getManager()->getConnection()->fetchAssoc(
                'SELECT COLUMN_TYPE AS kind, IS_NULLABLE AS nullable,'
                . ' COLLATION_NAME AS collation'
                . ' FROM information_schema.COLUMNS'
                . ' WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?',
                array($table, $column));
        } catch (\Exception $e) {
            return null;
        }

        if (empty($row)) {
            return null;
        }

        // Nullability is not part of what MySQL compares, so leave it out: only
        // the type and, for text, the collation decide whether 150 comes back.
        return $row['kind'] . (empty($row['collation']) ? '' : ' ' . $row['collation']);
    }

    /** Every table the code maps, and whether it is actually there. */
    private function tables()
    {
        $em = $this->getDoctrine()->getManager();
        $existing = array();
        try {
            foreach ($em->getConnection()->getSchemaManager()->listTableNames() as $name) {
                $existing[strtolower($name)] = true;
            }
        } catch (\Exception $e) {
            return array();
        }

        $out = array();
        foreach ($em->getMetadataFactory()->getAllMetadata() as $meta) {
            if ($meta->isMappedSuperclass) {
                continue;
            }
            $table = $meta->getTableName();
            $out[] = array(
                'name' => $table,
                'entity' => $meta->getName(),
                'there' => isset($existing[strtolower($table)]),
            );
        }
        usort($out, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        return $out;
    }

    /** House ads whose format is not one of the five keys. */
    private function brokenFormats()
    {
        try {
            $rows = $this->getDoctrine()->getManager()->getConnection()->fetchAll(
                'SELECT id, format FROM house_ad_table WHERE format NOT IN (?, ?, ?, ?, ?)',
                array_keys(HouseAd::formats()));
        } catch (\Exception $e) {
            // The table is not there yet, which the schema list already says.
            return array();
        }

        return $rows;
    }
}
