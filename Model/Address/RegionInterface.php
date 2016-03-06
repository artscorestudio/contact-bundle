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