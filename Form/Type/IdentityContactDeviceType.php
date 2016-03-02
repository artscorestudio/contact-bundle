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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use ASF\ContactBundle\Form\DataTransformer\StringToIdentityTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * Identity Contact Device Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityContactDeviceType extends AbstractType
{
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $identityContactDeviceManager;
	
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $identityManager;
	
	/**
	 * @param ASFContactEntityManagerInterface $identity_contact_device_manager
	 * @param ASFContactEntityManagerInterface $identity_manager
	 */
	public function __construct(ASFContactEntityManagerInterface $identity_contact_device_manager, ASFContactEntityManagerInterface $identity_manager)
	{
		$this->identityContactDeviceManager = $identity_contact_device_manager;
		$this->identityManager = $identity_manager;
	}
	
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('contactDevice', ContactDeviceType::class);
		
		$identityTransformer = new StringToIdentityTransformer($this->identityManager);
		$builder->add($builder->create('identity', HiddenType::class)->addModelTransformer($identityTransformer));
		
		$builder->add('isMain', CheckboxType::class, array(
			'label' => 'Main',
			'required' => false
		));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => $this->identityContactDeviceManager->getClassName(),
	        'translation_domain' => 'asf_contact',
	    ));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'identity_contact_device_type';
	}
}