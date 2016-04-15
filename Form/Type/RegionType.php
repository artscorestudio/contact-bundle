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
use Symfony\Component\OptionsResolver\OptionsResolver;

use ASF\CoreBundle\Model\Manager\ASFEntityManagerInterface;
use ASF\ContactBundle\Utils\Manager\DefaultEntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

/**
 * Region Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class RegionType extends AbstractType
{
	/**
	 * @var DefaultEntityManagerInterface
	 */
	protected $regionManager;
	
	/**
	 * @param DefaultEntityManagerInterface $regionManager
	 */
	public function __construct(DefaultEntityManagerInterface $regionManager)
	{
		$this->regionManager = $regionManager;
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