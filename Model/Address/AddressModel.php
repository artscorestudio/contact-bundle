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

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Address Model
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 * @ORM\Entity(repositoryClass="ASF\ContactBundle\Repository\AddressRepository")
 * @ORM\Table(name="asf_contact_address")
 * @ORM\HasLifecycleCallbacks
 */
abstract class AddressModel implements AddressInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(visible=false)
     * 
     * @var number
     */
	protected $id;
	
	/**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.contact.address.line1", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $line1;
	
	/**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.contact.address.line2", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $line2;
	
	/**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.contact.address.line3", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $line3;
	
	/**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.contact.address.zip_code", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $zipCode;
	
	/**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.contact.address.city", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $city;
	
	/**
     * @ORM\ManyToOne(targetEntity="Province", cascade={"persist"})
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id")
     * 
	 * @var \ASF\ContactBundle\Model\Address\ProvinceInterface
	 */
	protected $province;
	
	/**
     * @ORM\ManyToOne(targetEntity="Region", cascade={"persist"})
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     * 
	 * @var \ASF\ContactBundle\Model\Address\RegionInterface
	 */
	protected $region;
	
	/**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     * @GRID\Column(title="asf.contact.address.country", defaultOperator="like", operatorsVisible=false)
     * 
     * @var string
     */
	protected $country;
	
	/**
	 * @ORM\Column(type="float", nullable=true)
	 * @GRID\Column(title="asf.contact.address.latitude", defaultOperator="like", operatorsVisible=false)
	 * 
	 * @var float
	 */
	protected $latitude;
	
	/**
	 * @ORM\Column(type="float", nullable=true)
	 * @GRID\Column(title="asf.contact.address.longitude", defaultOperator="like", operatorsVisible=false)
	 * 
	 * @var float
	 */
	protected $longitude;
	
	/**
     * @ORM\OneToMany(targetEntity="IdentityAddress", mappedBy="address", cascade={"persist,"remove"})
     * 
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