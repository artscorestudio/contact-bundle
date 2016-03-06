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

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

/**
 * Constraints Validator for check if we have just one main address in identity entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class NotTwoSuchOrganizationsValidator extends ConstraintValidator
{
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Validator\ConstraintValidatorInterface::validate()
	 */
	public function validate($organizations, Constraint $constraint)
	{
		$orgas = array();
		
		foreach($organizations as $organization) {

			if ( !is_null($organization->getOrganization()) && !isset($orgas[$organization->getOrganization()->getId()]) ) {
				$orgas[$organization->getOrganization()->getId()] = true;
			} elseif ( !is_null($organization->getOrganization()) ) {
				$this->context->addViolation($constraint->message);
			}
		}
	}
}