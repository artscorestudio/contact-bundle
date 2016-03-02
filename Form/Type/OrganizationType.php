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
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Organization Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class OrganizationType extends AbstractType
{
    /**
     * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
     */
    protected $organizationManager;
    
    /**
     * @param ASFContactEntityManagerInterface $person_manager
     */
    public function __construct(ASFContactEntityManagerInterface $organization_manager)
    {
        $this->organizationManager = $organization_manager;
    }
    
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('identity', IdentityType::class)
			->add('name', TextType::class, array(
				'label' => 'Name',
			));
	}

	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
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
		return 'organization_type';
	}
}