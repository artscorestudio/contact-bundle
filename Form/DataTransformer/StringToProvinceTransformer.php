<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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