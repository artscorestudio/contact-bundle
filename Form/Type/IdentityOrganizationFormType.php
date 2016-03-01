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
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use ASF\CoreBundle\Model\Manager\ASFEntityManagerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Identity Organization Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityOrganizationFormType extends AbstractType
{
	/**
	 * @var ASFEntityManagerInterface
	 */
	protected $identityOrganizationManager;
	
	/**
	 * @var ASFEntityManagerInterface
	 */
	protected $identityManager;
	
	/**
	 * @var ASFEntityManagerInterface
	 */
	protected $organizationManager;
	
	/**
	 * @param ASFEntityManagerInterface $organization_identity_manager
	 * @param ASFEntityManagerInterface $identity_manager
	 * @param ASFEntityManagerInterface $organization_manager
	 */
	public function __construct(IdentityOrganizationManager $identity_organization_manager, IdentityManager $identity_manager, OrganizationManager $organization_manager)
	{
		$this->identityOrganizationManager = $identity_organization_manager;
		$this->identityManager = $identity_manager;
		$this->organizationManager = $organization_manager;
	}
	
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$identityTransformer = new StringToIdentityTransformer($this->identityManager);
		$builder->add($builder->create('organization', 'genemu_jqueryautocomplete_entity', array(
			'label' => 'Organization',
			'translation_domain' => 'asf_contact',
			'class' => $this->organizationManager->getClassName(),
			'property' => 'name',
			'attr' => array('class' => 'autocomplete-elm', 'data-ajax-url' => 'cd31_contact_ajax_request_for_organization')
		))->addModelTransformer($identityTransformer));
		
		$builder->add($builder->create('member', 'hidden')->addModelTransformer($identityTransformer));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => $this->identityOrganizationManager->getClassName()
		));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'identity_organization_type';
	}
}