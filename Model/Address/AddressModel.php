<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace ASF\ContactBundle\Model\Address;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Address Model
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
abstract class AddressModel implements AddressInterface
{
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var string
	 */
	protected $line1;
	
	/**
	 * @var string
	 */
	protected $line2;
	
	/**
	 * @var string
	 */
	protected $line3;
	
	/**
	 * @var string
	 */
	protected $zipCode;
	
	/**
	 * @var string
	 */
	protected $city;
	
	/**
	 * @var string
	 */
	protected $province;
	
	/**
	 * @var \ASF\ContactBundle\Entity\Region
	 */
	protected $region;
	
	/**
	 * @var string
	 */
	protected $country;
	
	/**
	 * @var float
	 */
	protected $latitude;
	
	/**
	 * @var float
	 */
	protected $longitude;
	
	/**
	 * @var ArrayCollection
	 */
	protected $identities; 
	
	public function __construct()
	{
		$this->identities = new ArrayCollection();
	}
	
	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return string
	 */
	public function getLine1()
	{
		return $this->line1;
	}
	
	/**
	 * @param string $line1
	 * @return \ASF\ContactBundle\Model\Address\Address
	 */
	public function setLine1($line1)
	{
		$this->line1 = $line1;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getLine2()
	{
		return $this->line2;
	}
	
	/**
	 * @param string $line2
	 * @return \ASF\ContactBundle\Model\Address\Address
	 */
	public function setLine2($line2)
	{
		$this->line2 = $line2;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getLine3()
	{
		return $this->line3;
	}
	
	/**
	 * @param string $line3
	 * @return \ASF\ContactBundle\Model\Address\Address
	 */
	public function setLine3($line3)
	{
		$this->line3 = $line3;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getZipCode()
	{
		return $this->zipCode;
	}
	
	/**
	 * @param string $zip_code
	 * @return \ASF\ContactBundle\Model\Address\Address
	 */
	public function setZipCode($zip_code)
	{
		$this->zipCode = $zip_code;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}
	
	/**
	 * @param string $city
	 * @return \ASF\ContactBundle\Model\Address\Address
	 */
	public function setCity($city)
	{
		$this->city = $city;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getProvince()
	{
		return $this->province;
	}
	
	/**
	 * @param string $city
	 * @return \ASF\ContactBundle\Model\Address\Address
	 */
	public function setProvince($province)
	{
		$this->province = $province;
		return $this;
	}
	
	/**
	 * @return \ASF\ContactBundle\Entity\Region
	 */
	public function getRegion()
	{
		return $this->region;
	}
	
	/**
	 * @param \ASF\ContactBundle\Entity\Region $region
	 * @return \ASF\ContactBundle\Model\Address\Address
	 */
	public function setRegion($region)
	{
		$this->region = $region;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCountry()
	{
		return $this->country;
	}
	
	/**
	 * @param string $country
	 * @return \ASF\ContactBundle\Model\Address\Address
	 */
	public function setCountry($country)
	{
		$this->country = $country;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getLatitude()
	{
		return $this->latitude;
	}
	
	/**
	 * @param float $latitude
	 * @return \ASF\ContactBundle\Model\Address\Address
	 */
	public function setLatitude($latitude)
	{
		$this->latitude = $latitude;
		return $this;
	}
	
	/**
	 * @return float
	 */
	public function getLongitude()
	{
		return $this->longitude;
	}
	
	/**
	 * @param float $longitude
	 * @return \ASF\ContactBundle\Model\Address\Address
	 */
	public function setLongitude($longitude)
	{
		$this->longitude = $longitude;
		return $this;
	}
	
	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getIdentities()
	{
		return $this->identities;
	}
}