<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) 2012-2015 Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use ASF\CoreBundle\Model\Manager\ASFEntityManagerInterface;

use ASF\ContactBundle\Model\Identity\IdentityModel;
use ASF\ContactBundle\Entity\Manager\ASFContactEntityManagerInterface;

/**
 * Identity Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityType extends AbstractType
{
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $identityManager;
	
	/**
	 * @param ASFContactEntityManagerInterface $identity_manager
	 */
	public function __construct(ASFContactEntityManagerInterface $identity_manager)
	{
		$this->identityManager = $identity_manager;
	}
	
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('state', 'choice', array(
			'label' => 'State',
			'required' => true,
			'choices' => array(
				IdentityModel::STATE_ENABLED => 'Activated',
				IdentityModel::STATE_DISABLED => 'Deactivated'
			)
		))
		->add('organizations', 'base_collection', array(
			'type' => IdentityOrganizationType::class,
			'label' => 'List of organizations',
			'allow_add' => true,
			'allow_delete' => true,
			'prototype' => true,
			'containerId' => 'organizations-collection'
		));
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