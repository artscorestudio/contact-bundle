<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) 2012-2015 Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Model\Person;

use ASF\ContactBundle\Model\Identity\IdentityInterface;

/**
 * Person Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface PersonInterface extends IdentityInterface
{
	/**
	 * Get Person first name
	 *
	 * @return string
	 */
	public function getFirstName();
	
	/**
	 * Set Person first name
	 *
	 * @param string $first_name
	 * @return \ASF\ContactBundle\Model\Person\PersonInterface
	 */
	public function setFirstName($first_name);
	
	/**
	 * Get Person last name
	 * 
	 * @return string
	 */
	public function getLastName();
	
	/**
	 * Set Person last name
	 * 
	 * @param string $last_name
	 * @return \ASF\ContactBundle\Model\Person\PersonInterface
	 */
	public function setLastName($last_name);
	
}