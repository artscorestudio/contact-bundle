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
use ASF\ContactBundle\Model\ContactDevice\ContactDeviceModel;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * ContactDeviceType.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ContactDeviceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', ChoiceType::class, array(
            'label' => 'asf.contact.form.contact_device.label.type',
            'choices' => array(
                ContactDeviceModel::TYPE_EMAIL => 'asf.contact.form.contact_device.label.type.email',
                ContactDeviceModel::TYPE_PHONE => 'asf.contact.form.contact_device.label.type.phone',
                ContactDeviceModel::TYPE_WEBSITE => 'asf.contact.form.contact_device.label.type.website',
            )
        ))
        ->add('label', ChoiceType::class, array(
            'label' => 'asf.contact.form.contact_device.label.label',
            'choices' => array(
                ContactDeviceModel::LABEL_EMAIL => ContactDeviceModel::LABEL_EMAIL,
                ContactDeviceModel::LABEL_MOBILE_PHONE => ContactDeviceModel::LABEL_MOBILE_PHONE,
                ContactDeviceModel::LABEL_PHONE => ContactDeviceModel::LABEL_PHONE,
                ContactDeviceModel::LABEL_PHONE_PRO => ContactDeviceModel::LABEL_PHONE_PRO,
                ContactDeviceModel::LABEL_WEBSITE => ContactDeviceModel::LABEL_WEBSITE,
                ContactDeviceModel::LABEL_WEBSITE_PRO => ContactDeviceModel::LABEL_WEBSITE_PRO,
            ),
            'attr' => array('class' => 'suggest-contactD-label'),
            'required' => false
        ))
        ->add('value', TextType::class, array(
            'label' => 'asf.contact.form.contact_device.label.value',
        ));
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::getBlockPrefix()
     */
    public function getBlockPrefix()
    {
        return 'contact_device_type';
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
