<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace ASF\ContactBundle\Model\ContactDevice;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Contact Device Model
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
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
	 * @var integer
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $label;
	
	/**
	 * @var string
	 */
	protected $value;
	
	/**
	 * @var ArrayCollection
	 */
	protected $identities;
	
	/**
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
	 * @return number
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return string
	 */
	public function getLabel()
	{
		return $this->label;
	}
	
	/**
	 * @param string $label
	 * @return \ASF\ContactBundle\Model\Identity\ContactDevice
	 */
	public function setLabel($label)
	{
		$this->label = $label;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}
	
	/**
	 * @param string $value
	 * @return \ASF\ContactBundle\Model\Identity\ContactDevice
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
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * @param string $type
	 * @return \ASF\ContactBundle\Model\Identity\ContactDevice
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

}