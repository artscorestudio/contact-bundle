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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Search Identity Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class SearchIdentityType extends AbstractType
{
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label' => 'asf.contact.form.label.search_a_contact',
            'choice_label' => 'name',
            'placeholder' => 'asf.contact.form.placeholder.choose_a_contact',
            'identity_type' => null
        ));
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::getParent()
     */
    public function getParent()
    {
        return EntityType::class;
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::getBlockPrefix()
     */
    public function getBlockPrefix()
    {
        return 'search_identity';
    }
    
    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
