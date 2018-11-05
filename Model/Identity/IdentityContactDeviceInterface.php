<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Model\Identity;

use ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface;

/**
 * Identity Contact Device Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface IdentityContactDeviceInterface
{
    /**
     * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
     */
    public function getIdentity();
    
    /**
     * @param \ASF\ContactBundle\Model\Identity\IdentityInterface $idetntity
     * @return \ASF\ContactBundle\Model\Identity\IdentityContactDeviceInterface
     */
    public function setIdentity(IdentityInterface $identity);
    
    /**
     * @return \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface
     */
    public function getContactDevice();
    
    /**
     * @param \ASF\ContactBundle\Model\ContactDevice\ContactDeviceInterface $contactDevice
     * @return \ASF\ContactBundle\Model\Identity\IdentityContactDeviceInterface
     */
    public function setContactDevice(ContactDeviceInterface $contactDevice);
}
