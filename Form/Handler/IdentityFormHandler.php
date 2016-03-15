<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Form\Handler;

use ASF\CoreBundle\Form\Handler\FormHandlerModel;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Identity Form Handler
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityFormHandler extends FormHandlerModel
{
	/**
	 * @var ContainerInterface
	 */
	protected $container;
	
	/**
	 * @param FormInterface      $form
	 * @param ContainerInterface $container
	 */
	public function __construct(FormInterface $form, Request $request, ContainerInterface $container)
	{
		parent::__construct($form, $request);
		$this->container = $container;
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
				$isIdentityExist = $this->container->get('asf_contact.identity.manager')->getRepository()->findOneBy(array('name' => $model->getName()));
				if ( !is_null($isIdentityExist) ) {
					$this->flashMessage->danger($this->translator->trans('A contact with that name already exists', array(), 'AsfContact'));
					return false;
				}
			}
			
			if ( !is_null($model->getAccount()) ) {
				$model->getAccount()->setEmail($model->getMainEmailAddress());
			}
			
			$this->updateIdentityOrganizationsRelations($model);
			
			if ( $this->container->has('asf_contact.address.manager') ) {
                $this->updateIdentityAddressRelations($model);
			}
			
			if ( $this->container->has('asf_contact.contact_device.manager') ) {
                $this->updateIdentityContactDeviceRelations($model);
			}
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
		
		if ( is_null($form_identity_orgas) ) {
		    return;
		}
		   
		foreach($form_identity_orgas as $identity_orga) {
			if ( !isset($orgas[$identity_orga->getOrganization()->getId()]) )
				$orgas[$identity_orga->getOrganization()->getId()] = 1;
			else
				$model->removeOrganization($identity_orga);
		}
		
		// Detecte relations removed
		$relations = $this->container->get('asf_contact.identity_organization.manager')->getRepository()->findBy(array('member' => $model->getId()));
		foreach($relations as $relation) {
			$found = false;
			foreach($model->getOrganizations() as $identity_organization) {
				if ( $relation->getOrganization()->getId() == $identity_organization->getOrganization()->getId() ) {
					$found = true;
				}
			}
			if ( false === $found ) {
				$this->container->get('asf_contact.identity_organization.manager')->getEntityManager()->remove($relation);
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
				$this->container->get('asf_contact.identity.manager')->getEntityManager()->persist($identity_organization);
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
		$relations = $this->container->get('asf_contact.identity_address.manager')->getRepository()->findBy(array('identity' => $model->getId()));
		foreach($relations as $relation) {
			$found = false;
			foreach($model->getAddresses() as $identity_address) {
				if ( $relation->getAddress()->getId() == $identity_address->getAddress()->getId() ) {
					$found = true;
				}
			}
			if ( false === $found ) {
				$this->container->get('asf_contact.identity.manager')->getEntityManager()->remove($relation);
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
				$this->container->get('asf_contact.identity.manager')->getEntityManager()->persist($identity_address);
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
				$contact_device = $this->container->get('asf_contact.contact_device.manager')->createTypedInstance($identity_contact_device->getContactDevice()->getType());
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
		$relations = $this->container->get('asf_contact.identity_contact_device.manager')->getRepository()->findBy(array('identity' => $model->getId()));
		foreach($relations as $relation) {
			$found = false;
			foreach($model->getContactDevices() as $identity_contact_device) {
				if ( $relation->getContactDevice()->getId() == $identity_contact_device->getContactDevice()->getId() ) {
					$found = true;
				}
			}
			if ( false === $found ) {
				$this->container->get('asf_contact.identity.manager')->getEntityManager()->remove($relation);
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
				$this->container->get('asf_contact.identity.manager')->getEntityManager()->persist($identity_contact_devices);
			}
		}
	}
}