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

use ASF\ContactBundle\Model\Organization\OrganizationInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Organization Entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class Organization extends Identity implements OrganizationInterface
{
	/**
	 * Type of subdivision
	 *
	 * @var string
	 */
	const SUBDIVISION_POLE           = 'pole';
	const SUBDIVISION_CENTRE_ROUTIER = 'centre_routier';
	const SUBDIVISION_SERVICE        = 'service';
	const SUBDIVISION_DIRECTION      = 'direction';
	
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 */
	protected $members;
	
	/**
	 * @var string
	 */
	protected $subdivision;
	
	public function __construct()
	{
		$this->members = new ArrayCollection();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Organization\OrganizationInterface::getMembers()
	 */
	public function getMembers()
	{
		return $this->members;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Organization\OrganizationInterface::addMember()
	 */
	public function addMember($member)
	{
		$this->members->add($member);
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Organization\OrganizationInterface::removeMember()
	 */
	public function removeMember($member)
	{
		$this->members->removeElement($member);
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getSubdivision()
	{
		return $this->subdivision;
	}
	
	/**
	 * @param string $subdivision
	 * @return \ASF\ContactBundle\Entity\Organization
	 */
	public function setSubdivision($subdivision)
	{
		$this->subdivision = $subdivision;
		return $this;
	}
}