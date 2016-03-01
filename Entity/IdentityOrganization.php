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

/**
 * Identity Organization Entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityOrganization
{
	/**
	 * @var integer
	 */
	protected $id;
	
	/**
	 * @var \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	protected $member;
	
	/**
	 * @var \ASF\ContactBundle\Model\Organization\OrganizationInterface
	 */
	protected $organization;
	
	/**
	 * @return number
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function getMember()
	{
		return $this->member;
	}
	
	/**
	 * @param \ASF\ContactBundle\Model\Identity\IdentityInterface $member
	 * @return \ASF\ContactBundle\Entity\IdentityOrganization
	 */
	public function setMember($member)
	{
		$this->member = $member;
		return $this;
	}
	
	/**
	 * @return \ASF\ContactBundle\Model\Organization\OrganizationInterface
	 */
	public function getOrganization()
	{
		return $this->organization;
	}
	
	/**
	 * @param \ASF\ContactBundle\Model\Organization\OrganizationInterface $organization
	 * @return \ASF\ContactBundle\Entity\IdentityOrganization
	 */
	public function setOrganization($organization)
	{
		$this->organization = $organization;
		return $this;
	}
}