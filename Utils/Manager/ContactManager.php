<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Utils\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Contact Manager for this bundle
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ContactManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    
    /**
     * @var ContainerInterface
     */
    protected $container;
    
    /**
     * @param EntityManagerInterface $em
     * @param ContainerInterface     $container
     */
    public function __construct(EntityManagerInterface $em, ContainerInterface $container)
    {
        $this->em = $em;
        $this->container = $container;
    }
    
    /**
     * Create a Identity Instance.
     *
     * @return object
     */
    public function createIdentityInstance()
    {
        $class = new \ReflectionClass($this->container->getParameter('asf_contact.identity.entity'));
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create a Person Instance.
     *
     * @return object
     */
    public function createPersonInstance()
    {
        $class = new \ReflectionClass($this->container->getParameter('asf_contact.person.entity'));
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create a Organization Instance.
     *
     * @return object
     */
    public function createOrganizationInstance()
    {
        $class = new \ReflectionClass($this->container->getParameter('asf_contact.organization.entity'));
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create new IdentityOrganization Instance.
     *
     * @return object
     */
    public function createIdentityOrganizationInstance()
    {
        $class = new \ReflectionClass($this->container->getParameter('asf_contact.identity_organization.entity'));
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create new IdentityAddress Instance.
     *
     * @return object
     */
    public function createIdentityAddressInstance()
    {
        if ( false === $this->container->hasParameter('asf_contact.identity_address.entity') ) {
            throw new \Exception('The parameter asf_contact.identity_address.entity must be defined.');
        }
        
        $class = new \ReflectionClass($this->container->getParameter('asf_contact.identity_address.entity'));
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create new IdentityContactDevice Instance.
     *
     * @return object
     */
    public function createIdentityContactDeviceInstance()
    {
        if ( false === $this->container->hasParameter('asf_contact.identity_contact_device.entity') ) {
            throw new \Exception('The parameter asf_contact.identity_contact_device.entity must be defined.');
        }
        
        $class = new \ReflectionClass($this->container->getParameter('asf_contact.identity_contact_device.entity'));
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create new typed ConactDevice Instance of entity
     *
     * @param string $type Type of instance
     */
    public function createTypedContactDeviceInstance($type)
    {
        if ( false === $this->container->hasParameter('asf_contact.contact_device.entity') ) {
            throw new \Exception('The parameter asf_contact.contact_device.entity must be defined.');
        }
        
        if ( $type == ContactDeviceModel::TYPE_EMAIL )
            $entityName = $this->emailAddressClassName;
        elseif ( $type == ContactDeviceModel::TYPE_PHONE )
            $entityName = $this->phoneNumberClassName;
        elseif ( $type == ContactDeviceModel::TYPE_WEBSITE )
            $entityName = $this->websiteAddressClassName;
        else
            throw new \Exception(sprintf('The type "%s" is not a valid ContactDevice inheritance entity', $type));
    
        $entity = new $entityName();
        return $entity;
    }
    
    /**
     * Create new Address Instance.
     *
     * @return object
     */
    public function createAddressInstance()
    {
        if ( false === $this->container->hasParameter('asf_contact.address.entity') ) {
            throw new \Exception('The parameter asf_contact.address.entity must be defined.');
        }
        
        $class = new \ReflectionClass($this->container->getParameter('asf_contact.address.entity'));
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create new Province Instance.
     *
     * @return object
     */
    public function createProvinceInstance()
    {
        if ( false === $this->container->hasParameter('asf_contact.province.entity') ) {
            throw new \Exception('The parameter asf_contact.province.entity must be defined.');
        }
        
        $class = new \ReflectionClass($this->container->getParameter('asf_contact.province.entity'));
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create new Region Instance.
     *
     * @return object
     */
    public function createRegionInstance()
    {
        if ( false === $this->container->hasParameter('asf_contact.region.entity') ) {
            throw new \Exception('The parameter asf_contact.region.entity must be defined.');
        }
        
        $class = new \ReflectionClass($this->container->getParameter('asf_contact.region.entity'));
    
        return $class->newInstanceArgs();
    }
    
    /**
     * @param string $entityClassName Name of the ASFContactBundle parameter (ex. : asf_contact.identity.entity)
     * @return boolean
     */
    public function isEntityEnabled($entityClassName)
    {
        return $this->container->hasParameter($entityClassName);
    }
}
