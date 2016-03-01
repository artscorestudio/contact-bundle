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

use APY\DataGridBundle\Grid\Mapping as GRID;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Identity Model
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 * @GRID\Source(columns="name,emailCanonical,state,type,id,updatedAt,createdAt")
 */
abstract class IdentityModel
{
	/**
	 * Type of Identity for Doctrine discriminator
	 * 
	 * - TYPE_PERSON for Person entity
	 * - TYPE_ORGANISATION for Organisation entity
	 * 
	 * @var string
	 */
	const TYPE_PERSON         = 'person';
	const TYPE_ORGANIZATION   = 'organization';
	
	/**
	 * Allowed states for identity entity

	 * @var string
	 */
	const STATE_ENABLED  = 'enabled';
	const STATE_DISABLED = 'disabled';
	
	/**
	 * @var integer
	 */
	protected $id;
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var string
	 */
	protected $state;
	
	/**
	 * @var string
	 */
	protected $emailCanonical;
	
	/**
	 * @var \ASF\ContactBundle\Model\Identity\IdentityAccountInterface
	 */
	protected $account;
	
	/**
	 * @var ArrayCollection
	 */
	protected $organizations;
	
	/**
	 * @var \DateTime
	 */
	protected $createdAt;
	
	/**
	 * @var \DateTime
	 */
	protected $updatedAt;
	
	/**
	 * @var string
	 */
	protected $discr;
	
	/**
	 * @var string
	 */
	protected $type;
	
	public function __construct()
	{
		$this->createdAt = new \DateTime();
		$this->updatedAt = new \DateTime();
		
		$this->organizations = new ArrayCollection();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::getId()
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::getName()
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::setName()
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::getState()
	 */
	public function getState()
	{
		return $this->state;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::setState()
	 */
	public function setState($state)
	{
		$this->state = $state;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::getEmailCanonical()
	 */
	public function getEmailCanonical()
	{
		return $this->emailCanonical;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::setEmailCanonical()
	 */
	public function setEmailCanonical($email)
	{
		$this->emailCanonical = $email;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::getAccount()
	 */
	public function getAccount()
	{
		return $this->account;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::setAccount()
	 */
	public function setAccount(IdentityAccountInterface $account)
	{
		$this->account = $account;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::getOrganizations()
	 */
	public function getOrganizations()
	{
		return $this->organizations;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::addOrganization()
	 */
	public function addOrganization($organization)
	{
		if ( !$this->organizations->contains($organization) )
			$this->organizations->add($organization);
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::removeOrganization()
	 */
	public function removeOrganization($organization)
	{
		if ( $this->organizations->contains($organization) )
			$this->organizations->removeElement($organization);
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::getCreatedAt()
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::setCreatedAt()
	 */
	public function setCreatedAt(\DateTime $date)
	{
		$this->createdAt = $date;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::getUpdatedAt()
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::setUpdatedAt()
	 */
	public function setUpdatedAt(\DateTime $date)
	{
		$this->updatedAt = $date;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::getType()
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::setType()
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getDiscr()
	{
		return $this->discr;
	}
	
	/**
	 * @param string $discr
	 * @return \ASF\ContactBundle\Model\Identity\IdentityModel
	 */
	public function setDiscr($discr)
	{
		$this->discr = $discr;
		return $this;
	}
	
	/**
	 * Update fields before persist
	 */
	public function onPrePersist()
	{
		$this->createdAt = new \DateTime();
	}
	
	/**
	 * Update fields before update
	 */
	public function onPreUpdate()
	{
		$this->updatedAt = new \DateTime();
	}

	/**
	 * Return state choices for entity validation
	 * 
	 * @return multitype:string
	 */
	public static function getStates()
	{
		return array(self::STATE_ENABLED, self::STATE_DISABLED);
	}
	
	/**
	 * Return type choices for entity validation
	 *
	 * @return multitype:string
	 */
	public static function getTypes()
	{
		return array(self::TYPE_PERSON, self::TYPE_ORGANISATION);
	}
}
