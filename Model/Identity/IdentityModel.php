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

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ASF\ContactBundle\Validator\Constraints as ContactAssert;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Doctrine\Common\Collections\ArrayCollection;
use ASF\ContactBundle\Model\ContactDevice\ContactDeviceModel;

/**
 * Identity Model
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 * @ORM\Entity(repositoryClass="ASF\ContactBundle\Repository\IdentityRepository")
 * @ORM\Table(name="asf_contact_identity")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"Person"="Person", "Organization"="Organization"})
 * @ORM\HasLifecycleCallbacks
 * 
 * @ContactAssert\IdentityAlreadyExists
 */
abstract class IdentityModel implements IdentityInterface
{
    /**
     * Type of Identity for Doctrine discriminator.
     * 
     * - TYPE_PERSON for Person entity
     * - TYPE_ORGANISATION for Organisation entity
     * 
     * @var string
     */
    const TYPE_PERSON         = 'person';
    const TYPE_ORGANIZATION   = 'organization';
    
    /**
     * Allowed states for identity entity.
     * 
     * @var string
     */
    const STATE_ENABLED  = 'enabled';
    const STATE_DISABLED = 'disabled';
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(visible=false)
     * 
     * @var number
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.contact.identity.name", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Choice(callback = "getStates")
     * @GRID\Column(title="asf.contact.identity.state", filter="select",  selectFrom="values", values={
     *     IdentityModel::STATE_ENABLED = "enabled",
     *     IdentityModel::STATE_DISABLED = "disabled",
     * }, defaultOperator="eq", operatorsVisible=false)
     *
     * @var string
     */
    protected $state;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.contact.identity.email_canonical", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
    protected $emailCanonical;
    
    /**
     * @ORM\OneToMany(targetEntity="IdentityOrganization", mappedBy="member", cascade={"persist"})
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     * 
     * @var ArrayCollection
     */
    protected $organizations;
    
    /**
     * @var ArrayCollection
     */
    protected $addresses;
    
    /**
     * @var ArrayCollection
     */
    protected $contactDevices;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @GRID\Column(visible=false)
     *
     * @var \DateTime
     */
    protected $createdAt;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @GRID\Column(visible=false)
     *
     * @var \DateTime
     */
    protected $updatedAt;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Choice(callback = "getTypes")
     * @GRID\Column(title="asf.contact.identity.type", filter="select",  selectFrom="values", values={
     *     IdentityModel::TYPE_PERSON = "Person",
     *     IdentityModel::TYPE_ORGANIZATION = "Organization"
     * }, defaultOperator="eq", operatorsVisible=false)
     *
     * @var string
     */
    protected $type;
    
    /**
     * @var string
     */
    protected $discr;
    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        
        $this->organizations = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->contactDevices = new ArrayCollection();
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
     * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::getAddresses()
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::addAddress()
     */
    public function addAddress($address)
    {
        if ( !$this->addresses->contains($address) )
            $this->addresses->add($address);
            return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::removeAddress()
     */
    public function removeAddress($address)
    {
        if ( $this->addresses->contains($address) )
            $this->addresses->removeElement($address);
            return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::getContactDevices()
     */
    public function getContactDevices()
    {
        return $this->contactDevices;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::addContactDevice()
     */
    public function addContactDevice($contact_device)
    {
        if ( !$this->contactDevices->contains($contact_device) )
            $this->contactDevices->add($contact_device);
            return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\ContactBundle\Model\Identity\IdentityInterface::removeContactDevice()
     */
    public function removeContactDevice($contact_device)
    {
        if ( $this->contactDevices->contains($contact_device) )
            $this->contactDevices->removeElement($contact_device);
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
        $this->updatedAt = new \DateTime();
        if ( is_array($this->contactDevices) ) {
            foreach($this->contactDevices as $contact_device) {
                if ( $contact_device->getContactDevice()->getType() == ContactDeviceModel::TYPE_EMAIL && $contact_device->getIsMain() == true ) {
                    $this->emailCanonical = $contact_device->getContactDevice()->getValue();
                }
            }
        }
    }
    
    /**
     * Update fields before update
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
        if ( is_array($this->contactDevices) ) {
            foreach($this->contactDevices as $contact_device) {
                if ( $contact_device->getContactDevice()->getType() == ContactDeviceModel::TYPE_EMAIL && $contact_device->getIsMain() == true ) {
                    $this->emailCanonical = $contact_device->getContactDevice()->getValue();
                }
            }
        }
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
