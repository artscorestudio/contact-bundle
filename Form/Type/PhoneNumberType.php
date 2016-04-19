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

/**
 * Phone number Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class PhoneNumberType extends AbstractType
{
	/**
	 * @var DefaultManagerInterface
	 */
	protected $phoneNumberManager;
	
	/**
	 * @param DefaultManagerInterface $phoneNumberManager
	 */
	public function __construct(DefaultManagerInterface $phoneNumberManager)
	{
		$this->phoneNumberManager = $phoneNumberManager;
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