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

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use ASF\ContactBundle\Form\DataTransformer\StringToIdentityTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * Identity Address Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityAddressType extends AbstractType
{
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $identityAddressManager;
	
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $identityManager;
	
	/**
	 * @param ASFContactEntityManagerInterface $identity_address_manager
	 * @param ASFContactEntityManagerInterface $identity_manager
	 */
	public function __construct(ASFContactEntityManagerInterface $identity_address_manager, ASFContactEntityManagerInterface $identity_manager)
	{
		$this->identityAddressManager = $identity_address_manager;
		$this->identityManager = $identity_manager;
	}
	
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('address', AddressType::class);
		
		$identity_transformer = new StringToIdentityTransformer($this->identityManager);
		$builder->add($builder->create('identity', HiddenType::class)->addModelTransformer($identity_transformer));
		
		$builder->add('isMain', CheckboxType::class, array(
			'label' => 'Check this box if you want to make this address your principal address',
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
	        'data_class' => $this->identityAddressManager->getClassName(),
	        'translation_domain' => 'asf_contact',
	    ));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'identity_address_type';
	}
}