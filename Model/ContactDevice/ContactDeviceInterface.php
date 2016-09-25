<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Model\ContactDevice;

/**
 * Contact Device Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface ContactDeviceInterface
{
	/**
     * @return number
     */
    public function getId();
    
    /**
     * @return string
     */
    public function getLabel();
    
    /**
     * @param string $label
     * @return \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface
     */
    public function setLabel($label);
    
    /**
     * @return string
     */
    public function getValue();
    
    /**
     * @param string $value
     * @return \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface
     */
    public function setValue($value);
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getIdentities();
    
    /**
     * @return string
     */
    public function getType();
    
    /**
     * @param string $type
     * @return \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface
     */
    public function setType($type);
}