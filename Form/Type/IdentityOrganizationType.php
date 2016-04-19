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
	 * @var DefaultManagerInterface
	 */
	protected $identityOrganizationManager;
	
	/**
	 * @var DefaultManagerInterface
	 */
	protected $identityManager;
	
	/**
	 * @param DefaultManagerInterface $identityOrganizationManager
	 * @param DefaultManagerInterface $identityManager
	 */
	public function __construct(DefaultManagerInterface $identityOrganizationManager, DefaultManagerInterface $identityManager)
	{
		$this->identityOrganizationManager = $identityOrganizationManager;
		$this->identityManager = $identityManager;
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