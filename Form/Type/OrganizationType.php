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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Organization Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class OrganizationType extends AbstractType
{
    /**
     * @var DefaultEntityManagerInterface
     */
    protected $organizationManager;
    
    /**
     * @var EventSubscriberInterface
     */
    protected $subscriber;
    
    /**
     * @param DefaultEntityManagerInterface $person_manager
     */
    public function __construct(DefaultEntityManagerInterface $organizationManager, EventSubscriberInterface $subscriber)
    {
        $this->organizationManager = $organizationManager;
        $this->subscriber = $subscriber;
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
			
        $builder->addEventSubscriber($this->subscriber);
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