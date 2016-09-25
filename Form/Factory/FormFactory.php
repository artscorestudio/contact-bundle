<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Form\Factory;

use Symfony\Component\Form\FormFactoryInterface;

/**
 * Contact Bundle form factory
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class FormFactory implements FactoryInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var string
     */
    private $type;
    
    /**
     * @var string
     */
    private $entityClassName;
    
    /**
     * @var array
     */
    private $validationGroups;
    
    /**
     * @param FormFactoryInterface $formFactory
     * @param string               $name
     * @param string               $type
     * @param string               $entityClassName
     * @param array                $validationGroups
     */
    public function __construct(FormFactoryInterface $formFactory, $name, $type, $entityClassName, array $validationGroups = null)
    {
        $this->formFactory = $formFactory;
        $this->name = $name;
        $this->type = $type;
        $this->entityClassName = $entityClassName;
        $this->validationGroups = $validationGroups;
    }
    
    /**
     * {@inheritDoc}
     * @see \ASF\ProductBundle\Form\Factory\FormFactoryInterface::createForm()
     */
    public function createForm(array $options = array())
    {
        $options = array_merge(array(
            'validation_groups' => $this->validationGroups,
            'data_class' => $this->entityClassName
        ), $options);

        return $this->formFactory->createNamed($this->name, $this->type, null, $options);
    }
}