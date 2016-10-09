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
     * @var RequestStack
     */
    protected $request;
    
    /**
     * @var string
     */
    protected $addressEntityClassName;
    
    /**
     * @param RequestStack $request
     * @param string       $addressEntityClassName
     */
    public function __construct(RequestStack $request, $addressEntityClassName)
    {
        $this->request = $request;
        $this->addressEntityClassName = $addressEntityClassName;
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
            'inherit_data' => true ,
            'class' => $this->addressEntityClassName
        ));
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::getBlockPrefix()
     */
    public function getBlockPrefix()
    {
        return 'geoloc_type';
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
