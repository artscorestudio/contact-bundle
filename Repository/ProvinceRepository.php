<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Province Repository
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ProvinceRepository extends EntityRepository
{
	/**
	 * Find province by region
	 * 
	 * @param string $region_id
	 */
	public function findByRegion($region_id)
	{
		$qb = $this->createQueryBuilder('p');
		$qb instanceof QueryBuilder;
		
		$qb->leftJoin('ASFContactBundle:Region', 'r', 'WITH', 'p.region=r.id')
			->where('p.region=:region_id')
			->orderBy('p.code', 'ASC')
			->setParameter('region_id', $region_id);
		
		return $qb->getQuery()->getResult();
	}
}