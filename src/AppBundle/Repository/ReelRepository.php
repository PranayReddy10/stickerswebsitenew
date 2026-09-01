<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Feed queries for the Reels tab. Everything here returns only reels that are
 * enabled and past moderation, so a hidden or pending reel can never leak into
 * a public feed.
 */
class ReelRepository extends EntityRepository
{
    const PER_PAGE = 20;

    /** Newest reels from everyone - the default Reels tab. */
    public function findFeed($page)
    {
        return $this->visibleQueryBuilder()
            ->addOrderBy('r.created', 'DESC')
            ->addOrderBy('r.id', 'DESC')
            ->setFirstResult(self::PER_PAGE * $page)
            ->setMaxResults(self::PER_PAGE)
            ->getQuery()
            ->getResult();
    }

    /** Newest reels from the people this user follows. */
    public function findFollowing($page, $userId)
    {
        return $this->visibleQueryBuilder()
            ->leftJoin('u.followers', 'f')
            ->andWhere('f.id = :follower')
            ->setParameter('follower', $userId)
            ->addOrderBy('r.created', 'DESC')
            ->addOrderBy('r.id', 'DESC')
            ->setFirstResult(self::PER_PAGE * $page)
            ->setMaxResults(self::PER_PAGE)
            ->getQuery()
            ->getResult();
    }

    /** A single user's reels, for their profile grid. */
    public function findByUser($page, $userId)
    {
        return $this->visibleQueryBuilder()
            ->andWhere('u.id = :author')
            ->setParameter('author', $userId)
            ->addOrderBy('r.created', 'DESC')
            ->addOrderBy('r.id', 'DESC')
            ->setFirstResult(self::PER_PAGE * $page)
            ->setMaxResults(self::PER_PAGE)
            ->getQuery()
            ->getResult();
    }

    /** Everything a moderator still has to look at. */
    public function findPendingReview()
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.user', 'u')
            ->where('r.review = true')
            ->addOrderBy('r.created', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // ------------------------------------------------------------- dashboard

    /** Reels the app can show, for the dashboard's count. */
    public function countVisible()
    {
        return (int) $this->visibleQueryBuilder()
            ->select('COUNT(r)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /** How many are still waiting for a moderator. */
    public function countPending()
    {
        return (int) $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->where('r.review = true')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /** Views and likes across every visible reel, as ['views' => n, 'likes' => n]. */
    public function totals()
    {
        $row = $this->visibleQueryBuilder()
            ->select('COALESCE(SUM(r.views), 0) AS views', 'COALESCE(SUM(r.likes), 0) AS likes')
            ->getQuery()
            ->getSingleResult();
        return array('views' => (int) $row['views'], 'likes' => (int) $row['likes']);
    }

    /** The handful worth looking at, most watched first. */
    public function findMostWatched($limit = 5)
    {
        return $this->visibleQueryBuilder()
            ->addOrderBy('r.views', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * How many reels were posted on each of the last {@code $days} days, oldest first,
     * as a date => count map with the quiet days filled in as zero - a chart cannot
     * draw the gaps itself.
     */
    public function postedPerDay($days = 14)
    {
        $since = new \DateTime('-' . ((int) $days - 1) . ' days');
        $since->setTime(0, 0, 0);

        $rows = $this->createQueryBuilder('r')
            ->select('r.created')
            ->where('r.created >= :since')
            ->setParameter('since', $since)
            ->getQuery()
            ->getResult();

        $counts = array();
        for ($i = 0; $i < (int) $days; $i++) {
            $day = clone $since;
            $day->modify('+' . $i . ' days');
            $counts[$day->format('Y-m-d')] = 0;
        }
        foreach ($rows as $row) {
            if (!($row['created'] instanceof \DateTime)) {
                continue;
            }
            $key = $row['created']->format('Y-m-d');
            if (isset($counts[$key])) {
                $counts[$key]++;
            }
        }
        return $counts;
    }

    private function visibleQueryBuilder()
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.user', 'u')
            ->where('r.enabled = true')
            ->andWhere('r.review = false');
    }
}
