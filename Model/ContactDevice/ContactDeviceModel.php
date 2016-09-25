<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Model\ContactDevice;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Contact Device Model
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 * @ORM\Entity(repositoryClass="ASF\ContactBundle\Repository\ContactDeviceRepository")
 * @ORM\Table(name="asf_contact_contact_device")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "ContactDevice"="ContactDevice", 
 *     "EmailAddress"="EmailAddress",
 *     "PhoneNumber"="PhoneNumber",
 *     "WebsiteAddress"="WebsiteAddress"
 * })
 * @ORM\HasLifecycleCallbacks
 */
abstract class ContactDeviceModel implements ContactDeviceInterface
{
    /**
     * Type of ContactDevice for Doctrine discriminator
     * 
     * @var string
     */
    const TYPE_EMAIL   = 'email_address';
    const TYPE_PHONE   = 'phone_number';
    const TYPE_WEBSITE = 'website_address';
    
    /**
     * Labels suggested for submissions
     *
     * @var string
     */
    const LABEL_EMAIL = 'E-mail';
    const LABEL_MOBILE_PHONE = 'Mobile';
    const LABEL_PHONE = 'Phone';
    const LABEL_PHONE_PRO = 'Professional Phone';
    const LABEL_WEBSITE = 'Personal Website';
    const LABEL_WEBSITE_PRO = 'Professional Website';
    
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
     * @GRID\Column(title="asf.contact.contact_device.label", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
    protected $label;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.contact.contact_device.value", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
    protected $value;
    
    /**
     * @ORM\OneToMany(targetEntity="IdentityContactDevice", mappedBy="contactDevice", cascade={"persist,"remove"})
     * 
     * @var ArrayCollection
     */
    protected $identities;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Choice(callback = "getTypes")
     * @GRID\Column(title="asf.contact.contact_device.type", filter="select",  selectFrom="values", values={
     *     ContactDeviceModel::TYPE_EMAIL = "email_address",
     *     ContactDeviceModel::TYPE_PHONE = "phone_number",
     *     ContactDeviceModel::TYPE_WEBSITE = "website_address",
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
        $this->identities = new ArrayCollection();
    }
    
    /**
     * {@inheritDoc}
     * @see \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface::getId()
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * {@inheritDoc}
     * @see \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface::getLabel()
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     * {@inheritDoc}
     * @see \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface::setLabel()
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
    
    /**
     * {@inheritDoc}
     * @see \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface::getValue()
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * {@inheritDoc}
     * @see \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface::setValue()
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface::getIdentities()
     */
    public function getIdentities()
    {
        return $this->identities;
    }
    
    /**
     * {@inheritDoc}
     * @see \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface::getType()
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * {@inheritDoc}
     * @see \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface::setType()
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
     * @return \ASF\ContactBundle\Model\Identity\ContactDevice
     */
    public function setDiscr($discr)
    {
        $this->discr = $discr;
        return $this;
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return array(
            self::TYPE_EMAIL,
            self::TYPE_PHONE,
            self::TYPE_WEBSITE
        );
    }
}