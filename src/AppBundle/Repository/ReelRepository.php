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

    private function visibleQueryBuilder()
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.user', 'u')
            ->where('r.enabled = true')
            ->andWhere('r.review = false');
    }
}
