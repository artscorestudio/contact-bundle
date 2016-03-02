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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

/**
 * Address Repository
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class AddressRepository extends EntityRepository
{
	/**
	 * Find identity by line1
	 *
	 * @param string $searched_term
	 */
	public function findByLine1Contains($searched_term)
	{
		$qb = $this->createQueryBuilder('a');
		$qb instanceof QueryBuilder;
		$searched_term = explode(' ', $searched_term);
		$where_clause = ''; $inc = 0; $parameters = new ArrayCollection();
		foreach($searched_term as $term) {
			if ($f == true) {
				$where_clause .= 'WHERE SOUNDEX(a.line1) = SOUNDEX(:searched_term'.$inc.')';
			} else {
				$where_clause .= 'OR SOUNDEX(a.line1) = SOUNDEX(:searched_term'.$inc.')';
			}
			$parameter = new Parameter(':searched_term'.$inc, $term);
			$parameters->add($parameter);
			$inc++;
		}
		$qb->andWhere($where_clause)->setParameters($parameters);
		
		return $qb->getQuery()->getResult();
	}
}