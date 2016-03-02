<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace ASF\ContactBundle\Form\Handler;

use ASF\CoreBundle\Form\Handler\FormHandlerModel;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Collections\ArrayCollection;

use Asf\Bundle\ContactBundle\Entity\Manager\IdentityManager;
use Asf\Bundle\ContactBundle\Entity\Manager\PersonManager;
use Asf\Bundle\ContactBundle\Entity\Manager\OrganizationManager;
use Asf\Bundle\ContactBundle\Entity\Manager\IdentityOrganizationManager;
use Asf\Bundle\ContactBundle\Model\Identity\IdentityInterface;
use Asf\Bundle\ContactBundle\Entity\Manager\AddressManager;
use Asf\Bundle\ContactBundle\Entity\Manager\IdentityAddressManager;
use Asf\Bundle\ContactBundle\Entity\Manager\IdentityContactDeviceManager;
use Asf\Bundle\ContactBundle\Entity\Manager\ContactDeviceManager;
use Asf\Bundle\ContactBundle\Model\ContactDevice\ContactDeviceModel;

/**
 * Identity Form Handler
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityFormHandler extends FormHandlerModel
{
	/**
	 * @var IdentityManager
	 */
	protected $identityManager;
	
	/**
	 * @var PersonManager
	 */
	protected $personManager;
	
	/**
	 * @var OrganizationManager
	 */
	protected $organizationManager;
	
	/**
	 * @var IdentityOrganizationManager
	 */
	protected $identityOrganizationManager;

	/**
	 * @var AddressManager
	 */
	protected $addressManager;
	
	/**
	 * @var IdentityAddressManager
	 */
	protected $identityAddressManager;
	
	/**
	 * @var IdentityContactDeviceManager
	 */
	protected $identityContactDeviceManager;
	
	/**
	 * @var ContactDeviceManager
	 */
	protected $contactDeviceManager;
	
	/**
	 * @param FormInterface                $form
	 * @param IdentityManager              $identity_manager
	 * @param PersonManager                $person_manager
	 * @param OrganizationManager          $organization_manager
	 * @param IdentityOrganizationManager  $identity_organization_manager
	 * @param AddressManager               $address_manager
	 * @param IdentityAddressManager       $identity_address_manager
	 * @param IdentityContactDeviceManager $identity_contact_device_manager
	 * @param ContactDeviceManager         $contact_device_manager
	 */
	public function __construct(FormInterface $form, $identity_manager, $person_manager, $organization_manager, $identity_organization_manager, $address_manager, $identity_address_manager, $identity_contact_device_manager, $contact_device_manager)
	{
		parent::__construct($form);
		
		$this->identityManager = $identity_manager;
		$this->personManager = $person_manager;
		$this->organizationManager = $organization_manager;
		$this->identityOrganizationManager = $identity_organization_manager;
		$this->addressManager = $address_manager;
		$this->identityAddressManager = $identity_address_manager;
		$this->identityContactDeviceManager = $identity_contact_device_manager;
		$this->contactDeviceManager = $contact_device_manager;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Asf\ApplicationBundle\Application\Form\FormHandlerModel::processForm()
	 * @throw \Exception
	 */
	public function processForm($model)
	{
		try {
			if ( is_null($model->getId()) ) {
				$isIdentityExist = $this->identityManager->getRepository()->findOneBy(array('name' => $model->getName()));
				if ( !is_null($isIdentityExist) ) {
					$this->flashMessage->danger($this->translator->trans('A contact with that name already exists', array(), 'AsfContact'));
					return false;
				}
			}
			
			if ( !is_null($model->getAccount()) ) {
				$model->getAccount()->setEmail($model->getMainEmailAddress());
			}
			
			$this->updateIdentityOrganizationsRelations($model);
			$this->updateIdentityAddressRelations($model);
			$this->updateIdentityContactDeviceRelations($model);

			$this->identityManager->getEntityManager()->persist($model);
			$this->identityManager->getEntityManager()->flush();
			
			return true;
			
		} catch (\Exception $e) {
			throw new \Exception(sprintf('An error occured : %s', $e->getMessage()));
		}
		
		return false;
	}
	
	/**
	 * Update relations between Identity entity and Organization entity
	 *
	 * @param IdentityInterface $model
	 */
	protected function updateIdentityOrganizationsRelations($model)
	{
		$orgas = array(); $form_identity_orgas = $model->getOrganizations();
		foreach($form_identity_orgas as $identity_orga) {
			if ( !isset($orgas[$identity_orga->getOrganization()->getId()]) )
				$orgas[$identity_orga->getOrganization()->getId()] = 1;
			else
				$model->removeOrganization($identity_orga);
		}
		
		// Detecte relations removed
		$relations = $this->identityOrganizationManager->getRepository()->findBy(array('member' => $model->getId()));
		foreach($relations as $relation) {
			$found = false;
			foreach($model->getOrganizations() as $identity_organization) {
				if ( $relation->getOrganization()->getId() == $identity_organization->getOrganization()->getId() ) {
					$found = true;
				}
			}
			if ( false === $found ) {
				$this->identityManager->getEntityManager()->remove($relation);
			}
		}
	
		// Detect new relations
		foreach($model->getOrganizations() as $identity_organization) {
			$found = false;
			foreach($relations as $relation) {
				if ( $relation->getOrganization()->getId() == $identity_organization->getOrganization()->getId() ) {
					$found = true;
				}
			}
			if ( false === $found ) {
				$identity_organization->setMember($model);
				$this->identityManager->getEntityManager()->persist($identity_organization);
			}
		}
	}
	
	/**
	 * Update relations between Identity entity and Address entity 
	 * 
	 * @param IdentityInterface $model
	 */
	protected function updateIdentityAddressRelations($model)
	{
		// Detect doublons
		$addresses = array(); $form_identity_addresses = $model->getAddresses();
		foreach($form_identity_addresses as $identity_address) {
			if ( !isset($addresses[$identity_address->getAddress()->getId()]) )
				$addresses[$identity_address->getAddress()->getId()] = 1;
			else
				$model->removeAddress($identity_address);
		}
		
		// Detect relations removed
		$relations = $this->identityAddressManager->getRepository()->findBy(array('identity' => $model->getId()));
		foreach($relations as $relation) {
			$found = false;
			foreach($model->getAddresses() as $identity_address) {
				if ( $relation->getAddress()->getId() == $identity_address->getAddress()->getId() ) {
					$found = true;
				}
			}
			if ( false === $found ) {
				$this->identityManager->getEntityManager()->remove($relation);
			}
		}
		
		// Detect new relations
		foreach($model->getAddresses() as $identity_address) {
			$found = false;
			foreach($relations as $relation) {
				if ( $relation->getAddress()->getId() == $identity_address->getAddress()->getId() ) {
					$found = true;
				}
			}
			if ( false === $found ) {
				$identity_address->setIdentity($model);
				$this->identityManager->getEntityManager()->persist($identity_address);
			}
		}
	}

	/**
	 * Update relations between Identity entity and Contact Device entity
	 *
	 * @param IdentityInterface $model
	 */
	protected function updateIdentityContactDeviceRelations($model)
	{
		foreach($model->getContactDevices() as $identity_contact_device) {
			if ( is_null($identity_contact_device->getId()) ) {
				$contact_device = $this->contactDeviceManager->createTypedInstance($identity_contact_device->getContactDevice()->getType());
				$contact_device->setType($identity_contact_device->getContactDevice()->getType())
					->setLabel($identity_contact_device->getContactDevice()->getLabel())
					->setValue($identity_contact_device->getContactDevice()->getValue());
				$identity_contact_device->setContactDevice($contact_device);
			}
		}
		
		$contact_devices = array(); $form_identity_contact_devices = $model->getContactDevices();
		foreach($form_identity_contact_devices as $identity_contact_device) {
			if ( !isset($contact_devices[$identity_contact_device->getContactDevice()->getId()]) )
				$contact_devices[$identity_contact_device->getContactDevice()->getId()] = 1;
			else
				$model->removeAddress($identity_contact_device);
		}
		
		// Detecte relations removed
		$relations = $this->identityContactDeviceManager->getRepository()->findBy(array('identity' => $model->getId()));
		foreach($relations as $relation) {
			$found = false;
			foreach($model->getContactDevices() as $identity_contact_device) {
				if ( $relation->getContactDevice()->getId() == $identity_contact_device->getContactDevice()->getId() ) {
					$found = true;
				}
			}
			if ( false === $found ) {
				$this->identityManager->getEntityManager()->remove($relation);
			}
		}
		
		// Detect new relations
		foreach($model->getContactDevices() as $identity_contact_devices) {
			$found = false;
			foreach($relations as $relation) {
				if ( $relation->getContactDevice()->getId() == $identity_contact_devices->getContactDevice()->getId() ) {
					$found = true;
				}
			}
			if ( false === $found ) {
				$identity_contact_devices->setIdentity($model);
				$this->identityManager->getEntityManager()->persist($identity_contact_devices);
			}
		}
	}
}