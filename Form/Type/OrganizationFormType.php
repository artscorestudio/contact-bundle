<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
 */
namespace CD31\ContactBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ASF\CoreBundle\Model\Manager\ASFEntityManagerInterface;

/**
 * Organization Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class OrganizationFormType extends AbstractType
{
	/**
	 * @var ASFEntityManagerInterface
	 */
	protected $organizationManager;
	
	/**
	 * @param unknown $organization_manager
	 */
	public function __construct(ASFEntityManagerInterface $organization_manager)
	{
		$this->organizationManager = $organization_manager;
	}
	
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('identity', 'identity_form_type')
			->add('name', 'text', array(
				'label' => 'Name',
			));
	}

	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\AbstractType::setDefaultOptions()
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'inherit_data' => true,
			'data_class' => $this->organizationManager->getClassName(),
			'translation_domain' => 'cd31_contact',
			'is_new' => false
		));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'organization_form_type';
	}
}