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

/**
 * Region Interface
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
interface RegionInterface
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
	 * @return string
	 */
	public function getCountry();

	/**
	 * @param string $country
	 * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
	 */
	public function setCountry($country);
}