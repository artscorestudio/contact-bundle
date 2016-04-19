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

use ASF\ContactBundle\Utils\Manager\DefaultManagerInterface;

/**
 * Transform a string to an identity entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class StringToIdentityTransformer implements DataTransformerInterface
{
	/**
	 * @var DefaultManagerInterface
	 */
	protected $identityManager;
	
	/**
	 * @var string
	 */
	protected $type;
	
	/**
	 * @param DefaultManagerInterface $identityManager
	 * @param null|string             $type
	 */
	public function __construct(DefaultManagerInterface $identityManager, $type = null)
	{
		$this->identityManager = $identityManager;
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