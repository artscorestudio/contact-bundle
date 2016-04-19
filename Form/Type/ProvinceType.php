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

use ASF\ContactBundle\Utils\Manager\DefaultManagerInterface;
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
	 * @var DefaultManagerInterface
	 */
	protected $provinceManager;
	
	/**
	 * @param DefaultManagerInterface $provinceManager
	 */
	public function __construct(DefaultManagerInterface $provinceManager)
	{
		$this->provinceManager = $provinceManager;
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