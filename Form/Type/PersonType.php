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
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Person Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class PersonType extends AbstractType
{
    /**
     * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
     */
    protected $personManager;
    
    /**
     * @var EventSubscriberInterface
     */
    protected $subscriber;
    
    /**
     * @param ASFContactEntityManagerInterface $person_manager
     */
    public function __construct(ASFContactEntityManagerInterface $person_manager, EventSubscriberInterface $subscriber)
    {
        $this->personManager = $person_manager;
        $this->subscriber = $subscriber;
    }
    
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('identity', IdentityType::class)
			->add('firstName', TextType::class, array(
				'label' => 'First Name',
				'required' => true
			))
			->add('lastName', TextType::class, array(
				'label' => 'Last Name',
				'required' => true
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
			'data_class' => $this->personManager->getClassName(),
			'translation_domain' => 'asf_contact',
			'is_new' => false
		));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'person_type';
	}
}