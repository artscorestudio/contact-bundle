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

use ASF\ContactBundle\Model\ContactDevice\ContactDeviceModel;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Contact Device Entity Manager for this bundle
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ContactDeviceManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    
    /**
     * @var string
     */
    protected $contactDeviceEntityClassName;
    
    /**
     * @var string
     */
    protected $identityContactDeviceEntityClassName;
    
    /**
     * @var string
     */
    protected $emailAddressEntityClassName;
    
    /**
     * @var string
     */
    protected $phoneNumberEntityClassName;
    
    /**
     * @var string
     */
    protected $websiteAddressEntityClassName;
    
    /**
     * @param EntityManagerInterface $em
     * @param string                 $contactDeviceEntityClassName
     * @param string                 $identityContactDeviceEntityClassName
     * @param string                 $emailAddressEntityClassName
     * @param string                 $websiteAddressEntityClassName
     * @param string                 $phoneNumberEntityClassName
     */
    public function __construct(EntityManagerInterface $em, $contactDeviceEntityClassName, $identityContactDeviceEntityClassName, $emailAddressEntityClassName, $websiteAddressEntityClassName, $phoneNumberEntityClassName)
    {
        $this->em = $em;
        $this->contactDeviceEntityClassName = $contactDeviceEntityClassName;
        $this->identityContactDeviceEntityClassName = $identityContactDeviceEntityClassName;
        $this->emailAddressEntityClassName = $emailAddressEntityClassName;
        $this->websiteAddressEntityClassName = $websiteAddressEntityClassName;
        $this->phoneNumberEntityClassName = $phoneNumberEntityClassName;
    }
    
    /**
     * Create new typed Instance of entity
     *
     * @param string $type Type of instance
     */
    public function createTypedInstance($type)
    {
        if ( $type == ContactDeviceModel::TYPE_EMAIL )
            $entityName = $this->emailAddressEntityClassName;
        elseif ( $type == ContactDeviceModel::TYPE_PHONE )
            $entityName = $this->phoneNumberEntityClassName;
        elseif ( $type == ContactDeviceModel::TYPE_WEBSITE )
            $entityName = $this->websiteAddressEntityClassName;
        else
            throw new \Exception(sprintf('The type "%s" is not a valid ContactDevice inheritance entity', $type));
    
        $entity = new $entityName();
        return $entity;
    }
    
    /**
     * Create new IdentityContactDevice Instance.
     *
     * @param string $type Type of instance
     */
    public function createIdentityContactDeviceInstance()
    {
        $class = new \ReflectionClass($this->identityContactDeviceEntityClassName);
    
        return $class->newInstanceArgs();
    }
}
