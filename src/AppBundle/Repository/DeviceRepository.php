<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Devices, and what they answer about how busy the app is.
 *
 * <p>The app registers for notifications every time the home screen opens, which
 * makes that endpoint an "app opened" ping. Writing down when it last happened is
 * all "active today" needs - no new call, and nothing to ship to phones.
 */
class DeviceRepository extends EntityRepository
{
	/****
	returns the number of entity's rows
	@return int
	*/
	public function count() {
		$query = $this->createQueryBuilder('e')->select('count(e)')->getQuery();
		return $query->getSingleScalarResult();
	}

	/** Devices that opened the app since the given moment. */
	public function countActiveSince(\DateTime $since)
	{
		return (int) $this->createQueryBuilder('d')
			->select('COUNT(d.id)')
			->where('d.seen >= :since')
			->setParameter('since', $since)
			->getQuery()->getSingleScalarResult();
	}

	/** Installs first seen since the given moment. */
	public function countNewSince(\DateTime $since)
	{
		return (int) $this->createQueryBuilder('d')
			->select('COUNT(d.id)')
			->where('d.created >= :since')
			->setParameter('since', $since)
			->getQuery()->getSingleScalarResult();
	}

	/** Everything the "how busy is it" strip shows, in one place. */
	public function activity()
	{
		return array(
			'today' => $this->countActiveSince(new \DateTime('today')),
			'yesterday' => $this->countActiveOn(new \DateTime('yesterday')),
			'week' => $this->countActiveSince(new \DateTime('-7 days')),
			'month' => $this->countActiveSince(new \DateTime('-30 days')),
			'new_today' => $this->countNewSince(new \DateTime('today')),
			'new_week' => $this->countNewSince(new \DateTime('-7 days')),
			'total' => (int) $this->count(),
			// Devices that have never been dated: everything installed before this
			// started being recorded. Worth showing so today's number is not read
			// as the whole audience.
			'undated' => (int) $this->createQueryBuilder('d')
				->select('COUNT(d.id)')->where('d.seen IS NULL')
				->getQuery()->getSingleScalarResult(),
		);
	}

	/** Active devices on one day, midnight to midnight - today against yesterday. */
	public function countActiveOn(\DateTime $day)
	{
		$next = clone $day;
		$next->modify('+1 day');

		return (int) $this->createQueryBuilder('d')
			->select('COUNT(d.id)')
			->where('d.seen >= :from')->andWhere('d.seen < :to')
			->setParameter('from', $day)
			->setParameter('to', $next)
			->getQuery()->getSingleScalarResult();
	}

	/**
	 * Active devices per day for the last fortnight, every day present.
	 *
	 * <p>A day with nobody has to be in the array or the chart draws a fortnight of
	 * activity out of three busy days.
	 */
	public function activePerDay($days = 14)
	{
		$counts = array();
		for ($i = $days - 1; $i >= 0; $i--) {
			$counts[date('Y-m-d', strtotime('-' . $i . ' days'))] = 0;
		}

		$rows = $this->createQueryBuilder('d')
			->select('d.seen AS seen')
			->where('d.seen >= :from')
			->setParameter('from', new \DateTime('-' . ($days - 1) . ' days midnight'))
			->getQuery()->getResult();

		foreach ($rows as $row) {
			if ($row['seen'] === null) {
				continue;
			}
			$key = $row['seen']->format('Y-m-d');
			if (isset($counts[$key])) {
				$counts[$key]++;
			}
		}
		return $counts;
	}
}
