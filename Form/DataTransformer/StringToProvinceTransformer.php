<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace ASF\ContactBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

use ASF\ContactBundle\Entity\Manager\ASFContactEntityManagerInterface;

/**
 * Transform a string to a Province Entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class StringToProvinceTransformer implements DataTransformerInterface
{
	/**
	 * @var ASFContactEntityManagerInterface
	 */
	private $provinceManager;
	
	/**
	 * @param ASFContactEntityManagerInterface $province_manager
	 */
	public function __construct(ASFContactEntityManagerInterface $province_manager)
	{
		$this->provinceManager = $province_manager;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\DataTransformerInterface::transform()
	 */
	public function transform($province)
	{
		if ( is_null($province) )
			return '';
		
		return $province->getName();
	}

	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\DataTransformerInterface::reverseTransform()
	 */
	public function reverseTransform($string)
	{
		$province = $this->provinceManager->getRepository()->findOneBy(array('name' => $string));
		return $province;
	}
}