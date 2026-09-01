<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Subscription;
use Doctrine\ORM\EntityRepository;

/**
 * The questions the subscriptions page asks.
 *
 * <p>"Live" is not simply state = active: a phone that stops opening the app stops
 * confirming its subscription, and a row nobody has confirmed for a few days is
 * not evidence of anything. Every count here uses the same two conditions so the
 * cards, the table and the chart can never disagree.
 */
class SubscriptionRepository extends EntityRepository
{
    /** The cut-off a row has to have been seen since to count as live. */
    private function freshness()
    {
        return new \DateTime('-' . Subscription::STALE_DAYS . ' days');
    }

    private function liveQueryBuilder()
    {
        return $this->createQueryBuilder('s')
            ->where('s.state = :active')
            ->andWhere('s.updated > :fresh')
            ->setParameter('active', Subscription::STATE_ACTIVE)
            ->setParameter('fresh', $this->freshness());
    }

    /** Everything the cards at the top of the page show. */
    public function totals()
    {
        $live = (int) $this->liveQueryBuilder()
            ->select('COUNT(s.id)')->getQuery()->getSingleScalarResult();

        $all = (int) $this->createQueryBuilder('s')
            ->select('COUNT(s.id)')->getQuery()->getSingleScalarResult();

        $devices = (int) $this->createQueryBuilder('s')
            ->select('COUNT(DISTINCT s.device)')->getQuery()->getSingleScalarResult();

        $people = (int) $this->createQueryBuilder('s')
            ->select('COUNT(DISTINCT u.id)')
            ->innerJoin('s.user', 'u')->getQuery()->getSingleScalarResult();

        $signedOut = (int) $this->createQueryBuilder('s')
            ->select('COUNT(s.id)')
            ->where('s.user IS NULL')->getQuery()->getSingleScalarResult();

        $renewing = (int) $this->liveQueryBuilder()
            ->select('COUNT(s.id)')
            ->andWhere('s.renewing = true')->getQuery()->getSingleScalarResult();

        return array(
            'live' => $live,
            'all' => $all,
            'ended' => $all - $live,
            'devices' => $devices,
            'people' => $people,
            'signed_out' => $signedOut,
            'renewing' => $renewing,
            'cancelling' => $live - $renewing,
        );
    }

    /** How many live and how many in total, per product. */
    public function byProduct()
    {
        $rows = $this->createQueryBuilder('s')
            ->select('s.product AS product, COUNT(s.id) AS total,'
                . ' SUM(CASE WHEN s.state = :active AND s.updated > :fresh THEN 1 ELSE 0 END) AS live')
            ->setParameter('active', Subscription::STATE_ACTIVE)
            ->setParameter('fresh', $this->freshness())
            ->groupBy('s.product')
            ->orderBy('total', 'DESC')
            ->getQuery()->getResult();

        foreach ($rows as $i => $row) {
            $rows[$i]['total'] = (int) $row['total'];
            $rows[$i]['live'] = (int) $row['live'];
        }
        return $rows;
    }

    /**
     * New subscriptions per day for the last fortnight, every day present.
     *
     * <p>Days with none have to be in the array or the chart would draw a fortnight
     * of activity out of three busy days.
     */
    public function startedPerDay($days = 14)
    {
        $counts = array();
        for ($i = $days - 1; $i >= 0; $i--) {
            $counts[date('Y-m-d', strtotime('-' . $i . ' days'))] = 0;
        }

        $rows = $this->createQueryBuilder('s')
            ->select('s.created AS created')
            ->where('s.created >= :from')
            ->setParameter('from', new \DateTime('-' . ($days - 1) . ' days midnight'))
            ->getQuery()->getResult();

        foreach ($rows as $row) {
            $key = $row['created']->format('Y-m-d');
            if (isset($counts[$key])) {
                $counts[$key]++;
            }
        }
        return $counts;
    }

    /**
     * Who subscribed more than once, most first.
     *
     * <p>Grouped by device rather than by account: somebody who resubscribes after
     * letting it lapse is the interesting case, and most of them never sign in.
     */
    public function repeatSubscribers($limit = 10)
    {
        return $this->createQueryBuilder('s')
            ->select('s.device AS device, COUNT(s.id) AS times, MAX(s.updated) AS last')
            ->where('s.device IS NOT NULL')
            ->groupBy('s.device')
            ->having('COUNT(s.id) > 1')
            ->orderBy('times', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()->getResult();
    }

    /** The list itself: newest first, narrowed to live or ended when asked. */
    public function listQuery($state = null)
    {
        $qb = $this->createQueryBuilder('s')
            ->leftJoin('s.user', 'u')->addSelect('u')
            ->orderBy('s.updated', 'DESC');

        if ($state === Subscription::STATE_ACTIVE) {
            $qb->where('s.state = :active')->andWhere('s.updated > :fresh')
                ->setParameter('active', Subscription::STATE_ACTIVE)
                ->setParameter('fresh', $this->freshness());
        } elseif ($state === Subscription::STATE_EXPIRED) {
            $qb->where('s.state <> :active OR s.updated <= :fresh')
                ->setParameter('active', Subscription::STATE_ACTIVE)
                ->setParameter('fresh', $this->freshness());
        }
        return $qb->getQuery();
    }

    /** The row for one purchase, which is what makes a repeat report an update. */
    public function findByToken($token)
    {
        if ($token === null || $token === '') {
            return null;
        }
        return $this->findOneBy(array('tokenhash' => sha1($token)));
    }

    /** Live subscriptions, for the dashboard card. */
    public function countLive()
    {
        return (int) $this->liveQueryBuilder()
            ->select('COUNT(s.id)')->getQuery()->getSingleScalarResult();
    }
}
