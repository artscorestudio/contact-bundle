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

/**
 * Contact Manager for this bundle
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class DefaultContactManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    
    /**
     * @var string
     */
    protected $identityClassName;
    
    /**
     * @var string
     */
    protected $personClassName;
    
    /**
     * @var string
     */
    protected $orgnizationClassName;

    /**
     * @param EntityManagerInterface $em
     * @param string                 $identityClassName
     * @param string                 $personClassName
     * @param string                 $orgnizationClassName
     */
    public function __construct(EntityManagerInterface $em, $identityClassName, $personClassName, $orgnizationClassName)
    {
        $this->em = $em;
        $this->identityClassName = $identityClassName;
        $this->personClassName = $personClassName;
        $this->orgnizationClassName = $orgnizationClassName;
    }
    
    /**
     * Create a Identity Instance.
     *
     * @return object
     */
    public function createIdentityInstance()
    {
        $class = new \ReflectionClass($this->identityClassName);
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create a Person Instance.
     *
     * @return object
     */
    public function createPersonInstance()
    {
        $class = new \ReflectionClass($this->personClassName);
    
        return $class->newInstanceArgs();
    }
    
    /**
     * Create a Organization Instance.
     *
     * @return object
     */
    public function createOrganizationInstance()
    {
        $class = new \ReflectionClass($this->orgnizationClassName);
    
        return $class->newInstanceArgs();
    }
}
