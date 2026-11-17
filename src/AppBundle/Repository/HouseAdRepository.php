<?php

namespace AppBundle\Repository;

use AppBundle\Entity\HouseAd;
use Doctrine\ORM\EntityRepository;

class HouseAdRepository extends EntityRepository
{
    public function count()
    {
        return $this->createQueryBuilder('a')->select('count(a)')
            ->getQuery()->getSingleScalarResult();
    }

    /** Everything, newest first, for the panel's list. */
    public function all()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.format', 'ASC')->addOrderBy('a.id', 'DESC')
            ->getQuery()->getResult();
    }

    /** The ones the app can actually be given. */
    public function servable()
    {
        $ads = $this->createQueryBuilder('a')
            ->where('a.enabled = true')->andWhere("TRIM(a.url) <> ''")
            ->orderBy('a.format', 'ASC')->addOrderBy('a.id', 'ASC')
            ->getQuery()->getResult();

        // isServable() also wants a picture, or a title for a native ad, and
        // neither is worth a second round trip to express in DQL.
        return array_values(array_filter($ads, function (HouseAd $ad) {
            return $ad->isServable();
        }));
    }

    /**
     * Impressions and clicks per format, for the panel's summary.
     *
     * @return array format => array(impressions, clicks, ads)
     */
    public function totalsByFormat()
    {
        $rows = $this->createQueryBuilder('a')
            ->select('a.format AS format', 'SUM(a.impressions) AS impressions',
                'SUM(a.clicks) AS clicks', 'COUNT(a.id) AS ads')
            ->groupBy('a.format')
            ->getQuery()->getArrayResult();

        $totals = array();
        foreach ($rows as $row) {
            $totals[$row['format']] = array(
                'impressions' => (int) $row['impressions'],
                'clicks' => (int) $row['clicks'],
                'ads' => (int) $row['ads'],
            );
        }

        return $totals;
    }
}
