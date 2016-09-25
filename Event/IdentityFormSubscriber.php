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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
     * @param boolean $isAddressEnabled
     * @param boolean $isContactDeviceEnabled
     */
    public function __construct($isAddressEnabled, $isContactDeviceEnabled)
    {
        $this->isAddressEnabled = $isAddressEnabled;
        $this->isContactDeviceEnabled = $isContactDeviceEnabled;
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
            $form->add('addresses', CollectionType::class, array(
                'entry_type' => IdentityAddressType::class,
                'label' => 'Addresses list',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ));
        }
        
        if ( true === $this->isContactDeviceEnabled ) {
            $form->add('contactDevices', CollectionType::class, array(
               'entry_type' => IdentityContactDeviceType::class,
               'label' => 'Contact device list',
               'allow_add' => true,
               'allow_delete' => true,
               'prototype' => true,
               'mapped' => true,
            ));
        }
    }
}