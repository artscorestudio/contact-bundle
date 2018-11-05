<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\ContactBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Constraints for check if identity already exists based on name attribute
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityAlreadyExistsValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    
    /**
     * @var string
     */
    protected $identityClassName;
    
    /**
     * @param EntityManagerInterface $em
     * @param string                 $identityClassName
     */
    public function __construct(EntityManagerInterface $em, $identityClassName)
    {
        $this->em = $em;
        $this->identityClassName = $identityClassName;
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Validator\ConstraintValidatorInterface::validate()
     */
    public function validate($identity, Constraint $constraint)
    {
        if ( is_null($identity->getId()) ) {
            $isIdentityExist = $this->em->getRepository($this->identityClassName)->findOneBy(array('name' => $identity->getName()));
            if ( !is_null($isIdentityExist) ) {
                $this->context->buildViolation($constraint->message)->addViolation();
            }
        }
    }
}