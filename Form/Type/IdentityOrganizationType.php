<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\ContactBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use ASF\ContactBundle\Model\Identity\IdentityModel;
use ASF\ContactBundle\Form\DataTransformer\StringToIdentityTransformer;
use Doctrine\ORM\EntityManagerInterface;
use ASF\ContactBundle\Utils\Manager\ContactManager;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * Identity Organization Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityOrganizationType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    protected  $em;
    
    /**
     * @var ContactManager
     */
    protected $contactManager;
    
    /**
     * @var string
     */
    protected $identityClassName;
    
    /**
     * @param EntityManagerInterface $em
     * @param ContactManager         $contactManager
     * @param string                 $identityClassName
     */
    public function __construct(EntityManagerInterface $em, ContactManager $contactManager, $identityClassName)
    {
        $this->em = $em;
        $this->contactManager = $contactManager;
        $this->identityClassName = $identityClassName;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('organization', SearchIdentityType::class, array(
            'identity_type' => IdentityModel::TYPE_ORGANIZATION,
            'class' => $this->identityClassName
        ));
        
        $identity_transformer = new StringToIdentityTransformer($this->em, $this->contactManager, $this->identityClassName, IdentityModel::TYPE_ORGANIZATION);
        $builder->add($builder->create('member', HiddenType::class)->addModelTransformer($identity_transformer));
        
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::getBlockPrefix()
     */
    public function getBlockPrefix()
    {
        return 'identity_organization_type';
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
