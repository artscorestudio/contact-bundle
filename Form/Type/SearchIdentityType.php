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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use ASF\ContactBundle\Utils\Manager\DefaultManagerInterface;
use ASF\ContactBundle\Form\DataTransformer\StringToIdentityTransformer;
use ASF\ContactBundle\Model\Identity\IdentityModel;

/**
 * Search Identity Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class SearchIdentityType extends AbstractType
{
    /**
     * @var string
     */
    protected $identityClassName;
    
    /**
     * @param string $identityClassName
     */
    public function __construct($identityClassName)
    {
        $this->identityClassName = $identityClassName;
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label' => 'asf.contact.identity.form.search_identity',
            'class' => $this->identityClassName,
            'choice_label' => 'name',
            'placeholder' => 'asf.contact.identity.form.search_an_identity',
            'attr' => array('class' => 'select2-entity-ajax', 'data-route' => 'asf_contact_ajax_request_identity_by_name'),
            'identity_type' => null
        ));
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::getParent()
     */
    public function getParent()
    {
        return EntityType::class;
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::getBlockPrefix()
     */
    public function getBlockPrefix()
    {
        return 'search_identity';
    }
    
    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}