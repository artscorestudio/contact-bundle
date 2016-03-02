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

/**
 * Phone number Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class PhoneNumberType extends AbstractType
{
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $phoneNumberManager;
	
	/**
	 * @param ASFContactEntityManagerInterface $phone_number_manager
	 */
	public function __construct(ASFContactEntityManagerInterface $phone_number_manager)
	{
		$this->phoneNumberManager = $phone_number_manager;
	}

	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => $this->phoneNumberManager->getClassName(),
			'translator_domain' => 'asf_contact'
		));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'phone_number_type';
	}
}