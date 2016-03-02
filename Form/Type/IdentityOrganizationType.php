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

use ASF\ContactBundle\Entity\Manager\ASFContactEntityManagerInterface;
use ASF\ContactBundle\Form\DataTransformer\StringToIdentityTransformer;
use ASF\ContactBundle\Model\Identity\IdentityModel;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * Identity Organization Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityOrganizationType extends AbstractType
{
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $identityOrganizationManager;
	
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $identityManager;
	
	/**
	 * @param ASFContactEntityManagerInterface $organization_identity_manager
	 */
	public function __construct(ASFContactEntityManagerInterface $identity_organization_manager, ASFContactEntityManagerInterface $identity_manager)
	{
		$this->identityOrganizationManager = $identity_organization_manager;
		$this->identityManager = $identity_manager;
	}
	
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('organization', SearchIdentityType::class, array(
		    'identity_type' => IdentityModel::TYPE_ORGANIZATION
		));
		
		$identity_transformer = new StringToIdentityTransformer($this->identityManager);
		$builder->add($builder->create('member', HiddenType::class)->addModelTransformer($identity_transformer));
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