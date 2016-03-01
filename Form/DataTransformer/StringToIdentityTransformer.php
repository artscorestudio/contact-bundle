<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace CD31\ContactBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use ASF\CoreBundle\Model\Manager\ASFEntityManagerInterface;

/**
 * Transform a string to an identity entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class StringToIdentityTransformer implements DataTransformerInterface
{
	/**
	 * @var ASFEntityManagerInterface
	 */
	private $identityManager;
	
	/**
	 * @param ASFEntityManagerInterface $identity_manager
	 */
	public function __construct(ASFEntityManagerInterface $identity_manager)
	{
		$this->identityManager = $identity_manager;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\DataTransformerInterface::transform()
	 */
	public function transform($identity)
	{
		if ( is_null($identity) )
			return '';
		
		return $identity->getName();
	}

	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\DataTransformerInterface::reverseTransform()
	 */
	public function reverseTransform($string)
	{
		$identity = $this->identityManager->getRepository()->findOneBy(array('name' => $string));
		if ( is_null($identity) ) {
			$identity = $this->identityManager->createInstance();
			$identity->setName($string);
		}
		return $identity;
	}
}