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
        '/^ALTER TABLE \S+ ADD /i',
        '/^CREATE (UNIQUE )?INDEX /i',
    );

    public function indexAction(Request $request)
    {
        $plan = $this->plan();

        return $this->render('AppBundle:Database:index.html.twig', array(
            'safe' => $plan['safe'],
            'manual' => $plan['manual'],
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
                $failed[] = $e->getMessage();
            }
        }

        if ($done > 0) {
            $this->addFlash('success', $done . ' change'
                . ($done == 1 ? '' : 's') . ' applied to the database.');
        }
        if (!empty($failed)) {
            $this->addFlash('error', count($failed) . ' failed: ' . implode(' | ', $failed));
        }
        if ($done === 0 && empty($failed)) {
            $this->addFlash('success', 'Nothing to do - the database already matches.');
        }

        return $this->redirect($this->generateUrl('app_database_index'));
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
