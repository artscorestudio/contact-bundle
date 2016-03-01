<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) 2012-2015 Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Model\Organization;

use ASF\ContactBundle\Model\Identity\IdentityInterface;

/**
 * Organization Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface OrganizationInterface extends IdentityInterface
{
	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getMembers();
	
	/**
	 * @param \ASF\ContactBundle\Model\Identity\IdentityInterface $member
	 * @return \ASF\ContactBundle\Model\Identity\OrganizationInterface
	 */
	public function addMember($member);
	
	/**
	 * @param \ASF\ContactBundle\Model\Identity\IdentityInterface $member
	 * @return \ASF\ContactBundle\Model\Identity\OrganizationInterface
	 */
	public function removeMember($member);
}