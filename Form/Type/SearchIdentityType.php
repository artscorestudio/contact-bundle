<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\Contact\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use ASF\CoreBundle\Model\Manager\ASFEntityManagerInterface;

use ASF\ContactBundle\Entity\Manager\ASFContactEntityManagerInterface;
use ASF\ContactBundle\Form\DataTransformer\StringToIdentityTransformer;

/**
 * Search Identity Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class SearchIdentityType extends AbstractType
{
    /**
     * @var ASFContactEntityManagerInterface|ASFEntityManagerInterface
     */
    protected $identityManager;
    
    /**
     * @param ASFContactEntityManagerInterface $identity_manager
     */
    public function __construct(ASFContactEntityManagerInterface $identity_manager)
    {
        $this->identityManager = $identity_manager;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $identity_transformer = new StringToIdentityTransformer($this->identityManager, $options['identity_type']);
        $builder->addModelTransformer($identity_transformer);
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label' => 'Identity',
            'class' => $this->identityManager->getClassName(),
            'choice_label' => 'Name',
            'placeholder' => 'Choose an identity',
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
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return 'search_identity';
    }
}