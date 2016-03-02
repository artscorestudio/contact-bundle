<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
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