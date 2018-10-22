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
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * AddressType.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('line1', TextType::class, array(
            'label' => 'asf.contact.form.address.line1',
            'attr' => array('class' => 'suggest-address-input')
        ))
        ->add('line2', TextType::class, array(
            'label' => 'asf.contact.form.address.line2',
            'required' => false
        ))
        ->add('line3', TextType::class, array(
            'label' => 'asf.contact.form.address.line3',
            'required' => false
        ))
        ->add('zipCode', TextType::class, array(
            'label' => 'asf.contact.form.address.zipCode',
        ))
        ->add('city', TextType::class, array(
            'label' => 'asf.contact.form.address.city',
        ))
        ->add('geoloc', GeolocType::class);
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::getBlockPrefix()
     */
    public function getBlockPrefix()
    {
        return 'address_type';
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
