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
use Doctrine\ORM\EntityRepository;

/**
 * Province Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ProvinceType extends AbstractType
{
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $provinceManager;
	
	/**
	 * @param ASFContactEntityManagerInterface|ASFEntityManagerInterface $province_manager
	 */
	public function __construct(ASFContactEntityManagerInterface $province_manager)
	{
		$this->provinceManager = $province_manager;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	        'label' => 'Province',
			'translator_domain' => 'asf_contact',
			'empty_value' => 'Please choice a province',
			'class' => $this->provinceManager->getClassName(),
			'query_builder' => function(EntityRepository $er) {
				return $er->createQueryBuilder('p')
					->orderBy('p.code', 'ASC');
			}
	    ));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'province_type';
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