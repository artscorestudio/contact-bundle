<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) 2012-2015 Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Model\Identity;

/**
 * Identity Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface IdentityInterface
{
	/**
	 * @return string
	 */
	public function getName();
	
	/**
	 * @param string $name
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function setName($name);
	
	/**
	 * @return \ASF\ContactBundle\Model\Identity\IdentityAccountInterface
	 */
	public function getAccount();
	
	/**
	 * @param \ASF\ContactBundle\Model\Identity\IdentityAccountInterface $account
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function setAccount(IdentityAccountInterface $account);
	
	/**
	 * Returns the organization to which the identity belongs
	 *
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getOrganizations();
	
	/**
	 * Add organization to the identity's organizations list
	 *
	 * @param mixed $organization
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function addOrganization($organization);
	
	/**
	 * Remove organization to the identity's organizations list
	 *
	 * @param mixed $organization
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function removeOrganization($organization);
}