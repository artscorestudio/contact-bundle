<?php
/**
 * This file is part of Artscore Studio Framework Package
 *
 * (c) 2012-2015 Artscore Studio <info@artscore-studio.fr>
 *
 * This source file is subject to the MIT Licence that is bundled
 * with this source code in the file LICENSE.
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