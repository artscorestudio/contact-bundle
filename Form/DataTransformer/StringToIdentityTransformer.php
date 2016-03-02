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
 * Transform a string to an identity entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class StringToIdentityTransformer implements DataTransformerInterface
{
	/**
	 * @var ASFContactEntityManagerInterface
	 */
	protected $identityManager;
	
	/**
	 * @var string
	 */
	protected $type;
	
	/**
	 * @param ASFContactEntityManagerInterface $identity_manager
	 */
	public function __construct(ASFContactEntityManagerInterface $identity_manager, $type = null)
	{
		$this->identityManager = $identity_manager;
		$this->type = $type;
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
	    $criterias = array('name' => $string);
	    if ( !is_null($this->type) ) {
	        $criterias['type'] = $this->type;
	    }
	    
		$identity = $this->identityManager->getRepository()->findOneBy($criterias);
		if ( is_null($identity) ) {
			$identity = $this->identityManager->createInstance();
			$identity->setName($string);
		}
		return $identity;
	}
}