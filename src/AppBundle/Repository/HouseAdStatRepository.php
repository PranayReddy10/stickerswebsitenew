<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class HouseAdStatRepository extends EntityRepository
{
    /**
     * The last N days, oldest first, with the days nothing happened filled in.
     *
     * <p>A chart with holes in it reads as a drop rather than as silence, so the
     * gaps are closed here instead of in the template.
     *
     * @return array of array(day, impressions, clicks)
     */
    public function recentDays($days = 14)
    {
        $from = new \DateTime('-' . ((int) $days - 1) . ' days');
        $from->setTime(0, 0, 0);

        $rows = $this->createQueryBuilder('s')
            ->select('s.day AS day', 'SUM(s.impressions) AS impressions', 'SUM(s.clicks) AS clicks')
            ->where('s.day >= :from')->setParameter('from', $from)
            ->groupBy('s.day')->orderBy('s.day', 'ASC')
            ->getQuery()->getArrayResult();

        $found = array();
        foreach ($rows as $row) {
            $key = $row['day'] instanceof \DateTime
                ? $row['day']->format('Y-m-d') : (string) $row['day'];
            $found[$key] = array(
                'impressions' => (int) $row['impressions'],
                'clicks' => (int) $row['clicks'],
            );
        }

        $out = array();
        for ($i = 0; $i < (int) $days; $i++) {
            $day = clone $from;
            $day->modify('+' . $i . ' days');
            $key = $day->format('Y-m-d');
            $out[] = array(
                'day' => $day,
                'impressions' => isset($found[$key]) ? $found[$key]['impressions'] : 0,
                'clicks' => isset($found[$key]) ? $found[$key]['clicks'] : 0,
            );
        }

        return $out;
    }

    /**
     * Adds to today's row for an ad, making it if this is the day's first event.
     *
     * <p>One statement, so two phones reporting at the same moment cannot each
     * read zero and each write one. The unique key on (ad, day) is what makes
     * the upsert safe; without it this would quietly grow a row per report.
     */
    public function record($adId, $format, $impressions, $clicks)
    {
        $sql = 'INSERT INTO house_ad_stat_table (ad_id, format, day, impressions, clicks)'
            . ' VALUES (:ad, :format, :day, :impressions, :clicks)'
            . ' ON DUPLICATE KEY UPDATE impressions = impressions + :impressions,'
            . ' clicks = clicks + :clicks';

        $this->getEntityManager()->getConnection()->executeUpdate($sql, array(
            'ad' => $adId,
            'format' => $format,
            'day' => date('Y-m-d'),
            'impressions' => (int) $impressions,
            'clicks' => (int) $clicks,
        ));
    }
}
