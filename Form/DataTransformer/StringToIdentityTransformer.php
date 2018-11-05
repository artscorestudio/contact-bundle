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
use Doctrine\ORM\EntityManagerInterface;
use ASF\ContactBundle\Utils\Manager\ContactManager;
use ASF\ContactBundle\Model\Identity\IdentityModel;

/**
 * Transform a string to an identity entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class StringToIdentityTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    
    /**
     * @var ContactManager
     */
    protected $contactManager;
    
    /**
     * @var string
     */
    protected $identityClassName;
    
    /**
     * @var string
     */
    protected $type;
    
    /**
     * @param EntityManagerInterface $em
     * @param ContactManager         $contactManager
     * @param string                 $identityClassName
     * @param string                 $type
     */
    public function __construct(EntityManagerInterface $em, ContactManager $contactManager, $identityClassName, $type)
    {
        $this->em = $em;
        $this->contactManager = $contactManager;
        $this->identityClassName = $identityClassName;
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
        $criterias = array('name' => $string, 'type' => $this->type);
        
        $identity = $this->em->getRepository($this->identityClassName)->findOneBy($criterias);
        if ( is_null($identity) ) {
            if ( $this->type === IdentityModel::TYPE_ORGANIZATION ) {
                $identity = $this->contactManager->createOrganizationInstance();
            } else {
                $identity = $this->contactManager->createPersonInstance();
            }
            $identity->setName($string);
        }
        return $identity;
    }
}