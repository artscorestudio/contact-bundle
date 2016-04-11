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

use ASF\CoreBundle\Model\Manager\ASFEntityManagerInterface;
use ASF\ContactBundle\Utils\Manager\DefaultEntityManagerInterface;

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
	 * @var DefaultEntityManagerInterface
	 */
	protected $identityAddressManager;
	
	/**
	 * @var DefaultEntityManagerInterface
	 */
	protected $identityManager;
	
	/**
	 * @param DefaultEntityManagerInterface $identityAddressManager
	 * @param DefaultEntityManagerInterface $identityManager
	 */
	public function __construct(DefaultEntityManagerInterface $identityAddressManager, DefaultEntityManagerInterface $identityManager)
	{
		$this->identityAddressManager = $identityAddressManager;
		$this->identityManager = $identityManager;
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