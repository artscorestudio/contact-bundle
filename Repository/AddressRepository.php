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