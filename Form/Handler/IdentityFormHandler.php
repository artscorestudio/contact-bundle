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

use ASF\ContactBundle\Model\Identity\IdentityInterface;
use ASF\ContactBundle\Utils\Manager\ContactManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Identity Form Handler
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityFormHandler
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    
    /**
     * @var ContactManager
     */
    protected $contactManager;
    
    /**
     * @var FlashMessage
     */
    protected $flashMessage;
    
    /**
     * @var TranslatorInterface
     */
    protected $translator;
    
    /**
     * @param EntityManagerInterface $entityManager
     * @param ContactManager $contactManager
     * @param FlashMessage $flashMessage
     */
    public function __construct(EntityManagerInterface $entityManager, ContactManager $contactManager, FlashMessage $flashMessage, TranslatorInterface $translator)
    {
        $this->entityManager = $entityManager;
        $this->contactManager = $contactManager;
        $this->flashMessage = $flashMessage;
        $this->translator = $translator;
    }
    
    /**
     * @param IdentityInterface $identity
     */
    public function processForm($identity)
    {
        $this->updateIdentityOrganizationsRelations($identity);
        
        if ( false !== $this->contactManager->isEntityEnabled('asf_contact.address.entity') ) {
            $this->updateIdentityAddressRelations($identity);
        }
        
        if ( false !== $this->contactManager->isEntityEnabled('asf_contact.contact_device.entity') ) {
            $this->updateIdentityContactDeviceRelations($identity);
        }
        return true;
    }
    
    /**
     * Update relations between Identity entity and Organization entity
     *
     * @param IdentityInterface $identity
     */
    protected function updateIdentityOrganizationsRelations($identity)
    {
        $orgas = array(); $form_identity_orgas = $identity->getOrganizations();
        
        if ( is_null($form_identity_orgas) ) {
            return;
        }
           
        foreach($form_identity_orgas as $identity_orga) {
            if ( !isset($orgas[$identity_orga->getOrganization()->getId()]) )
                $orgas[$identity_orga->getOrganization()->getId()] = 1;
            else
                $identity->removeOrganization($identity_orga);
        }
        
        // Detect relations removed
        $relations = $this->entityManager->getRepository($this->contactManager->getIdentityOrganizationClassName())->findBy(array('member' => $identity->getId()));
        foreach($relations as $relation) {
            $found = false;
            foreach($identity->getOrganizations() as $identity_organization) {
                if ( $relation->getOrganization()->getId() == $identity_organization->getOrganization()->getId() ) {
                    $found = true;
                }
            }
            if ( false === $found ) {
                $this->entityManager->remove($relation);
            }
        }
    
        // Detect new relations
        foreach($identity->getOrganizations() as $identity_organization) {
            $found = false;
            foreach($relations as $relation) {
                if ( $relation->getOrganization()->getId() == $identity_organization->getOrganization()->getId() ) {
                    $found = true;
                }
            }
            if ( false === $found ) {
                $identity_organization->setMember($identity);
                $this->entityManager->persist($identity_organization);
            }
        }
    }
    
    /**
     * Update relations between Identity entity and Address entity 
     * 
     * @param IdentityInterface $identity
     */
    protected function updateIdentityAddressRelations($identity)
    {
        // Detect relations removed
        $relations = $this->entityManager->getRepository($this->contactManager->getIdentityAddressClassName())->findBy(array('identity' => $identity->getId()));
        foreach($relations as $relation) {
            $found = false;
            foreach($identity->getAddresses() as $identity_address) {
                if ( $relation->getAddress()->getId() == $identity_address->getAddress()->getId() ) {
                    $found = true;
                }
            }
            if ( false === $found ) {
                $this->entityManager->remove($relation);
            }
        }
        
        // Detect new relations
        foreach($identity->getAddresses() as $identity_address) {
            $found = false;
            foreach($relations as $relation) {
                if ( $relation->getAddress()->getId() == $identity_address->getAddress()->getId() ) {
                    $found = true;
                }
            }
            if ( false === $found ) {
                $identity_address->setIdentity($identity);
                $this->entityManager->persist($identity_address);
            }
        }
    }

    /**
     * Update relations between Identity entity and Contact Device entity
     *
     * @param IdentityInterface $identity
     */
    protected function updateIdentityContactDeviceRelations($identity)
    {
        foreach($identity->getContactDevices() as $identity_contact_device) {
            if ( is_null($identity_contact_device->getId()) ) {
                $contact_device = $this->contactManager->createTypedContactDeviceInstance($identity_contact_device->getContactDevice()->getType());
                $contact_device->setType($identity_contact_device->getContactDevice()->getType())
                    ->setLabel($identity_contact_device->getContactDevice()->getLabel())
                    ->setValue($identity_contact_device->getContactDevice()->getValue());
                $identity_contact_device->setContactDevice($contact_device);
            }
        }
        
        $contact_devices = array(); $form_identity_contact_devices = $identity->getContactDevices();
        foreach($form_identity_contact_devices as $identity_contact_device) {
            if ( !isset($contact_devices[$identity_contact_device->getContactDevice()->getId()]) )
                $contact_devices[$identity_contact_device->getContactDevice()->getId()] = 1;
            else
                $identity->removeAddress($identity_contact_device);
        }
        
        // Detecte relations removed
        $relations = $this->entityManager->getRepository($this->contactManager->getIdentityContactDeviceClassName())->findBy(array('identity' => $identity->getId()));
        foreach($relations as $relation) {
            $found = false;
            foreach($identity->getContactDevices() as $identity_contact_device) {
                if ( $relation->getContactDevice()->getId() == $identity_contact_device->getContactDevice()->getId() ) {
                    $found = true;
                }
            }
            if ( false === $found ) {
                $this->entityManager->remove($relation);
            }
        }
        
        // Detect new relations
        foreach($identity->getContactDevices() as $identity_contact_devices) {
            $found = false;
            foreach($relations as $relation) {
                if ( $relation->getContactDevice()->getId() == $identity_contact_devices->getContactDevice()->getId() ) {
                    $found = true;
                }
            }
            if ( false === $found ) {
                $identity_contact_devices->setIdentity($identity);
                $this->entityManager->persist($identity_contact_devices);
            }
        }
    }
}
