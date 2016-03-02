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
use Symfony\Component\HttpFoundation\Request;

use ASF\CoreBundle\Model\Manager\ASFEntityManagerInterface;

use ASF\ContactBundle\Entity\Manager\ASFContactEntityManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Geolocalization Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class GeolocType extends AbstractType
{
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $provinceManager;
	
	/**
	 * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
	 */
	protected $regionManager;
	
	/**
	 * @var RequestStack
	 */
	protected $request;
	
	/**
	 * @param ASFContactEntityManagerInterface   $province_manager
	 * @param ASFContactEntityManagerInterface   $region_manager
	 * @param RequestStack                       $request
	 */
	public function __construct(ASFContactEntityManagerInterface $province_manager, ASFContactEntityManagerInterface $region_manager, RequestStack $request)
	{
		$this->provinceManager = $province_manager;
		$this->regionManager = $region_manager;
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