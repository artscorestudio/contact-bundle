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
use Symfony\Component\HttpFoundation\Request;

use ASF\ContactBundle\Utils\Manager\DefaultManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\HttpFoundation\RequestStack;
use ASF\ContactBundle\Utils\Manager\DefaultManagerInterface;

/**
 * Geolocalization Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class GeolocType extends AbstractType
{
	/**
	 * @var DefaultManagerInterface
	 */
	protected $provinceManager;
	
	/**
	 * @var DefaultManagerInterface
	 */
	protected $regionManager;
	
	/**
	 * @var RequestStack
	 */
	protected $request;
	
	/**
	 * @param DefaultManagerInterface   $provinceManager
	 * @param DefaultManagerInterface   $regionManager
	 * @param RequestStack              $request
	 */
	public function __construct(DefaultManagerInterface $provinceManager, DefaultManagerInterface $regionManager, RequestStack $request)
	{
		$this->provinceManager = $provinceManager;
		$this->regionManager = $regionManager;
		$this->request = $request;
	}
	
	/**
	 *  (non-PHPdoc)
	 * @see \Symfony\Component\Form\AbstractType::buildForm()
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('country', CountryType::class, array(
			'label' => 'Country',
			'required' => true,
			'preferred_choices' => array(strtoupper($this->request->getCurrentRequest()->getLocale()))
		))
		->add('province', ProvinceType::class)
		->add('region', RegionType::class);
	}

	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	        'inherit_data' => true,
	        'translation_domain' => 'asf_contact',
	    ));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'geoloc_type';
	}
}