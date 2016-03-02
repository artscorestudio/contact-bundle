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
	 * @return number
	 */
	public function getId();
	
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
	 * @return string
	 */
	public function getState();
	
	/**
	 * @param string $state
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function setState($state);
	
	/**
	 * @return string
	 */
	public function getEmailCanonical();
	
	/**
	 * @param string $email
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function setEmailCanonical($email);
	
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
	
	/**
	 * Return identity's addresses
	 *
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getAddresses();
	
	/**
	 * Add address to the identity's addresses list
	 *
	 * @param mixed $address
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function addAddress($address);
	
	/**
	 * Remove address to the identity's addresses list
	 *
	 * @param mixed $address
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function removeAddress($address);
	
	/**
	 * Return identity's contact devices
	 *
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getContactDevices();
	
	/**
	 * Add contact device to the identity's contact devices list
	 *
	 * @param mixed $contact_device
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function addContactDevice($contact_device);
	
	/**
	 * Remove contact device to the identity's contact devices list
	 *
	 * @param mixed $contact_device
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function removeContactDevice($contact_device);
	
	/**
	 * @return DateTime
	 */
	public function getCreatedAt();
	
	/**
	 * @param \DateTime $date
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function setCreatedAt(\DateTime $date);
	
	/**
	 * @return DateTime
	 */
	public function getUpdatedAt();
	
	/**
	 * @param \DateTime $date
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function setUpdatedAt(\DateTime $date);
	
	/**
	 * @return string
	 */
	public function getType();
	
	/**
	 * @param string $type
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function setType($type);
}