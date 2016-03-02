<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use ASF\LayoutBundle\Form\Type\BaseCollectionType;
use ASF\ContactBundle\Form\Type\IdentityAddressType;
use ASF\ContactBundle\Form\Type\IdentityContactDeviceType;

/**
 * Identity Form Event Subscriber
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityFormSubscriber implements EventSubscriberInterface
{
    /**
     * @var boolean
     */
    protected $isAddressEnabled;

    /**
     * @var boolean
     */
    protected $isContactDeviceEnabled;
    
    /**
     * @param boolean $is_address_enabled
     * @param boolean $is_contact_device_enabled
     */
    public function __construct($is_address_enabled, $is_contact_device_enabled)
    {
        $this->isAddressEnabled = $is_address_enabled;
        $this->isContactDeviceEnabled = $is_contact_device_enabled;
    }
    
    /**
	 * Subscribed Events
	 */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => array('onPreSetData', 0)
        );
    }
    
    /**
     * On Identity PreSetData Event
     * 
     * @param FormEvent $event
     */
    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $identity = $event->getData();
        
        if ( true === $this->isAddressEnabled ) {
            $form->add('addresses', BaseCollectionType::class, array(
    		    'entry_type' => IdentityAddressType::class,
    		    'label' => 'Addresses list',
    		    'allow_add' => true,
    		    'allow_delete' => true,
    		    'prototype' => true,
    		    'containerId' => 'addresses-collection'
    		));
        }
        
        if ( true === $this->isContactDeviceEnabled ) {
            $form->add('contactDevices', BaseCollectionType::class, array(
                'entry_type' => IdentityContactDeviceType::class,
                'label' => 'Contact device list',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'mapped' => true,
                'containerId' => 'contact-devices-collection'
            ));
        }
    }
}