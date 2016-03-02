<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace ASF\ContactBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use ASF\CoreBundle\Model\Manager\ASFEntityManagerInterface;
use ASF\ContactBundle\Entity\Manager\ASFContactEntityManagerInterface;
use ASF\ContactBundle\Model\ContactDevice\ContactDeviceModel;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Contact Device Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ContactDeviceType extends AbstractType
{
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $contactDeviceManager;
	
	/**
	 * @param ASFContactEntityManagerInterface  $contact_device_manager
	 */
	public function __construct(ASFContactEntityManagerInterface $contact_device_manager)
	{
		$this->contactDeviceManager = $contact_device_manager;
	}

	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('type', ChoiceType::class, array(
			'label' => 'Type',
			'required' => true,
			'choices' => array(
				ContactDeviceModel::TYPE_EMAIL => 'E-mail',
				ContactDeviceModel::TYPE_PHONE => 'Phone',
				ContactDeviceModel::TYPE_WEBSITE => 'Website',
			)
		))
		->add('label', ChoiceType::class, array(
			'label' => 'Name',
			'required' => true,
			'choices' => array(
				ContactDeviceModel::LABEL_EMAIL => ContactDeviceModel::LABEL_EMAIL,
				ContactDeviceModel::LABEL_MOBILE_PHONE => ContactDeviceModel::LABEL_MOBILE_PHONE,
				ContactDeviceModel::LABEL_PHONE => ContactDeviceModel::LABEL_PHONE,
				ContactDeviceModel::LABEL_PHONE_PRO => ContactDeviceModel::LABEL_PHONE_PRO,
				ContactDeviceModel::LABEL_WEBSITE => ContactDeviceModel::LABEL_WEBSITE,
				ContactDeviceModel::LABEL_WEBSITE_PRO => ContactDeviceModel::LABEL_WEBSITE_PRO,
			),
			'attr' => array('class' => 'suggest-contactD-label')
		))
		->add('value', TextType::class, array(
			'label' => 'Value',
			'required' => true
		));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => $this->contactDeviceManager->getClassName(),
	        'translation_domain' => 'asf_contact',
	    ));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'contact_device_type';
	}
}