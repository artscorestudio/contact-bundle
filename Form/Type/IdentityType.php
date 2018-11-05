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
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use ASF\ContactBundle\Model\Identity\IdentityModel;

/**
 * IdentityType.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('state', ChoiceType::class, array(
            'label' => 'asf.contact.form.label.state',
            'choices' => array(
                'asf.contact.form.state.enabled' => IdentityModel::STATE_ENABLED,
                'asf.contact.form.state.disabled' => IdentityModel::STATE_DISABLED
            ),
            'choices_as_values' => true,
            'placeholder' => 'asf.contact.form.label.state.placeholder'
        ))
        
        ->add('organizations', CollectionType::class, array(
            'entry_type' => IdentityOrganizationType::class,
            'label' => 'asf.contact.form.label.organizations_list',
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true
        ));
    }

    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::getBlockPrefix()
     */
    public function getBlockPrefix()
    {
        return 'identity_type';
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}