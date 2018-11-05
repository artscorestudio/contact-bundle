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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Region Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class RegionType extends AbstractType
{
    /**
     * @var string
     */
    protected $entityClassName;
    
    /**
     * @param EntityManagerInterface $regionManager
     */
    public function __construct($entityClassName)
    {
        $this->entityClassName = $entityClassName;
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label' => 'asf.contact.form.address.region',
            'empty_value' => 'asf.contact.form.address.region.placeholder',
            'class' => $this->entityClassName,
            'choice_label' => 'name',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('p')
                    ->orderBy('p.name', 'ASC');
            }
        ));
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::getBlockPrefix()
     */
    public function getBlockPrefix()
    {
        return 'region_type';
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
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
