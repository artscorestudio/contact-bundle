<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) 2012-2015 Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Entity;

use ASF\ContactBundle\Model\Person\PersonInterface;

/**
 * Person Entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class Person extends Identity implements PersonInterface
{
	/**
	 * @var string
	 */
	protected $firstName;

	/**
	 * @var string
	 */
	protected $lastName;
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Person\PersonInterface::getFirstName()
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Person\PersonInterface::setFirstName()
	 */
	public function setFirstName($first_name)
	{
		$this->firstName = $first_name;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Person\PersonInterface::getLastName()
	 */
	public function getLastName()
	{
		return $this->lastName;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Person\PersonInterface::setLastName()
	 */
	public function setLastName($last_name)
	{
		$this->lastName = $last_name;
		return $this;
	}
}