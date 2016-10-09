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

use ASF\ContactBundle\Model\Address\AddressInterface;

/**
 * Identity Address Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface IdentityAddressInterface
{
    /**
     * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
     */
    public function getIdentity();
    
    /**
     * @param \ASF\ContactBundle\Model\Identity\IdentityInterface $idetntity
     * @return \ASF\ContactBundle\Model\Identity\IdentityAddressInterface
     */
    public function setIdentity(IdentityInterface $identity);
    
    /**
     * @return \ASF\ContactBundle\Model\Identity\AddressInterface
     */
    public function getAddress();
    
    /**
     * @param \ASF\ContactBundle\Model\Identity\AddressInterface $address
     * @return \ASF\ContactBundle\Model\Identity\IdentityAddressInterface
     */
    public function setAddress(AddressInterface $address);
}