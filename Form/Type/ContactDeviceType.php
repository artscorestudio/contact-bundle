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

use ASF\ContactBundle\Utils\Manager\DefaultManagerInterface;
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
	 * @var DefaultManagerInterface
	 */
	protected $contactDeviceManager;
	
	/**
	 * @param DefaultManagerInterface  $contactDeviceManager
	 */
	public function __construct(DefaultManagerInterface $contactDeviceManager)
	{
		$this->contactDeviceManager = $contactDeviceManager;
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