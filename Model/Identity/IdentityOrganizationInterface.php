<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Model\Identity;

/**
 * IdentityOrganization Interface
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface IdentityOrganizationInterface
{
	/**
	 * Get the organization member
	 * 
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function getMember();
	
	/**
	 * Set the organization member
	 * 
	 * @param \ASF\ContactBundle\Model\Identity\IdentityInterface $member
	 * @return \ASF\ContactBundle\Model\Identity\IdentityOrganizationInterface
	 */
	public function setMember($member);
	
	/**
	 * Get the organization
	 *
	 * @return \ASF\ContactBundle\Model\Identity\OrganizationInterface
	 */
	public function getOrganization();
	
	/**
	 * Set the organization
	 *
	 * @param \ASF\ContactBundle\Model\Identity\OrganizationInterface $organization
	 * @return \ASF\ContactBundle\Model\Identity\IdentityOrganizationInterface
	 */
	public function setOrganization($organization);
}