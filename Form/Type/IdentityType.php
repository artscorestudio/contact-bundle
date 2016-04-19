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

use ASF\ContactBundle\Model\Identity\IdentityModel;
use ASF\ContactBundle\Utils\Manager\DefaultManagerInterface;
use ASF\LayoutBundle\Form\Type\BaseCollectionType;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Identity Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityType extends AbstractType
{
	/**
	 * @var DefaultManagerInterface
	 */
	protected $identityManager;
	
	/**
	 * @var boolean
	 */
	protected $asfLayoutEnabled;
	
	/**
	 * @param DefaultManagerInterface $identityManager
	 * @param boolean                 $asfLayoutEnabled
	 */
	public function __construct(DefaultManagerInterface $identityManager, $asfLayoutEnabled)
	{
		$this->identityManager = $identityManager;
		$this->asfLayoutEnabled = $asfLayoutEnabled;
	}
	
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('state', ChoiceType::class, array(
			'label' => 'State',
			'required' => true,
			'choices' => array(
				IdentityModel::STATE_ENABLED => 'Activated',
				IdentityModel::STATE_DISABLED => 'Deactivated'
			)
		));
		
		if ( $this->asfLayoutEnabled === true ) {
			$builder->add('organizations', BaseCollectionType::class, array(
				'entry_type' => IdentityOrganizationType::class,
				'label' => 'List of organizations',
				'allow_add' => true,
				'allow_delete' => true,
				'prototype' => true,
				'containerId' => 'organizations-collection'
			));
		} else {
			$builder->add('organizations', CollectionType::class, array(
				'entry_type' => IdentityOrganizationType::class,
				'label' => 'List of organizations',
				'allow_add' => true,
				'allow_delete' => true,
				'prototype' => true
			));
		}
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'inherit_data' => true,
			'data_class' => $this->identityManager->getClassName(),
			'translation_domain' => 'asf_contact',
			'is_new' => false
		));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'identity_type';
	}
}