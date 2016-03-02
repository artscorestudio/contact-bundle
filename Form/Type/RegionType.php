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
use Symfony\Component\OptionsResolver\OptionsResolver;

use ASF\CoreBundle\Model\Manager\ASFEntityManagerInterface;
use ASF\ContactBundle\Entity\Manager\ASFContactEntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Region Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class RegionType extends AbstractType
{
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $regionManager;
	
	/**
	 * @param ASFContactEntityManagerInterface $region_manager
	 */
	public function __construct(ASFContactEntityManagerInterface $region_manager)
	{
		$this->regionManager = $region_manager;
	}

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'label' => 'Region / State',
			'translator_domain' => 'asf_contact',
			'empty_value' => 'Please choice a Region / State',
			'class' => $this->regionManager->getClassName(),
			'property' => 'name',
			'query_builder' => function(EntityRepository $er) {
				return $er->createQueryBuilder('p')
					->orderBy('p.name', 'ASC');
			}
		));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	        'label' => 'Region / State',
			'translator_domain' => 'asf_contact',
			'empty_value' => 'Please choice a Region / State',
			'class' => $this->regionManager->getClassName(),
			'property' => 'name',
			'query_builder' => function(EntityRepository $er) {
				return $er->createQueryBuilder('p')
					->orderBy('p.name', 'ASC');
			}
	    ));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'region_type';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Form\AbstractType::getParent()
	 */
	public function getParent()
	{
		return EntityType::class;
	}
}