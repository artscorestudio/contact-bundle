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
 * Address Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface AddressInterface
{
    /**
     * @return string
     */
    public function getId();
    
    /**
     * @return string
     */
    public function getLine1();
    
    /**
     * @param string $line1
     * @return \ASF\ContactBundle\Model\Address\AddressInterface
     */
    public function setLine1($line1);
    
    /**
     * @return string
     */
    public function getLine2();
    
    /**
     * @param string $line2
     * @return \ASF\ContactBundle\Model\Address\AddressInterface
     */
    public function setLine2($line2);
    
    /**
     * @return string
     */
    public function getLine3();
    
    /**
     * @param string $line3
     * @return \ASF\ContactBundle\Model\Address\AddressInterface
     */
    public function setLine3($line3);
    
    /**
     * @return string
     */
    public function getZipCode();
    
    /**
     * @param string $zip_code
     * @return \ASF\ContactBundle\Model\Address\AddressInterface
     */
    public function setZipCode($zip_code);
    
    /**
     * @return string
     */
    public function getCity();
    
    /**
     * @param string $city
     * @return \ASF\ContactBundle\Model\Address\AddressInterface
     */
    public function setCity($city);
    
    /**
     * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
     */
    public function getProvince();
    
    /**
     * @param \ASF\ContactBundle\Model\Address\ProvinceInterface $province
     * @return \ASF\ContactBundle\Model\Address\AddressInterface
     */
    public function setProvince($province);
    
    /**
     * @return \ASF\ContactBundle\Model\Address\RegionInterface
     */
    public function getRegion();
    
    /**
     * @param \ASF\ContactBundle\Model\Address\RegionInterface $region
     * @return \ASF\ContactBundle\Model\Address\Address
     */
    public function setRegion($region);
    
    /**
     * @return string
     */
    public function getCountry();
    
    /**
     * @param string $country
     * @return \ASF\ContactBundle\Model\Address\AddressInterface
     */
    public function setCountry($country);
    
    /**
     * @return float
     */
    public function getLatitude();
    
    /**
     * @param float $latitude
     * @return \ASF\ContactBundle\Model\Address\AddressInterface
     */
    public function setLatitude($latitude);
    
    /**
     * @return float
     */
    public function getLongitude();
    
    /**
     * @param float $longitude
     * @return \ASF\ContactBundle\Model\Address\AddressInterface
     */
    public function setLongitude($longitude);
    
	/**
	 * Return identities linked to this address
	 * 
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getIdentities();
}