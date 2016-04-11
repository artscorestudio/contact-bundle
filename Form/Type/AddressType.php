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

use ASF\ContactBundle\Utils\Manager\DefaultEntityManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Address Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class AddressType extends AbstractType
{
	/**
	 * @var DefaultEntityManagerInterface
	 */
	protected $addressManager;
	
	/**
	 * @param DefaultEntityManagerInterface  $address_manager
	 */
	public function __construct(DefaultEntityManagerInterface $addressManager)
	{
		$this->addressManager = $addressManager;
	}

	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('line1', TextType::class, array(
			'label' => 'Address 1',
			'required' => true,
			'attr' => array('class' => 'suggest-address-input')
		))
		->add('line2', TextType::class, array(
			'label' => 'Address 2',
			'required' => false
		))
		->add('line3', TextType::class, array(
			'label' => 'Address 3',
			'required' => false
		))
		->add('zipCode', TextType::class, array(
			'label' => 'Zip code',
			'required' => true
		))
		->add('city', TextType::class, array(
			'label' => 'City',
			'required' => true
		))
		->add('geoloc', GeolocType::class, array(
			'data_class' => $this->addressManager->getClassName()
		));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => $this->addressManager->getClassName(),
	        'translation_domain' => 'asf_contact',
	    ));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'address_type';
	}
}