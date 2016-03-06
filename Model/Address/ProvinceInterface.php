<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Model\Address;

/**
 * Province Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface ProvinceInterface
{
    /**
     * @return string
     */
    public function getCode();
    
    /**
     * @param string $code
     * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
     */
    public function setCode($code);
    
    /**
     * @return string
     */
    public function getName();
    
    /**
     * @param string $name
     * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
     */
    public function setName($name);
    
    /**
     * @return \ASF\ContactBundle\Entity\Region
     */
    public function getRegion();
    
    /**
     * @param \ASF\ContactBundle\Model\Address\RegionInterface $region
     * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
     */
    public function setRegion($region);
    
    /**
     * @return string
     */
    public function getCountry();
    
    /**
     * @param string $country
     * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
     */
    public function setCountry($country);
}