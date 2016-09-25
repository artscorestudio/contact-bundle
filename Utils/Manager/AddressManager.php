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
 * Address Entity Manager for this bundle
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class AddressManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    
    /**
     * @var string
     */
    protected $addressEntityClassName;
    
    /**
     * @var string
     */
    protected $identityAddressEntityClassName;
    
    /**
     * @var string
     */
    protected $provinceEntityClassName;
    
    /**
     * @var string
     */
    protected $regionEntityClassName;
    
    /**
     * @param EntityManagerInterface $em
     * @param string                 $addressEntityClassName
     * @param string                 $identityAddressEntityClassName
     * @param string                 $provinceEntityClassName
     * @param string                 $regionEntityClassName
     */
    public function __construct(EntityManagerInterface $em, $addressEntityClassName, $identityAddressEntityClassName, $provinceEntityClassName, $regionEntityClassName)
    {
        $this->em = $em;
        $this->addressEntityClassName = $addressEntityClassName;
        $this->identityAddressEntityClassName = $identityAddressEntityClassName;
        $this->provinceEntityClassName = $provinceEntityClassName;
        $this->regionEntityClassName = $regionEntityClassName;
        $this->phoneNumberEntityClassName = $phoneNumberEntityClassName;
    }
    
    /**
     * Create new Address Instance.
     * 
     * @return object
     */
    public function createAddressInstance()
    {
        $class = new \ReflectionClass($this->addressEntityClassName);
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create new IdentityAddress Instance.
     *
     * @return object
     */
    public function createIdentityAddressInstance()
    {
        $class = new \ReflectionClass($this->identityAddressEntityClassName);
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create new Province Instance.
     *
     * @return object
     */
    public function createProvinceInstance()
    {
        $class = new \ReflectionClass($this->provinceEntityClassName);
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create new Region Instance.
     *
     * @return object
     */
    public function createRegionInstance()
    {
        $class = new \ReflectionClass($this->regionEntityClassName);
    
        return $class->newInstanceArgs();
    }
}
