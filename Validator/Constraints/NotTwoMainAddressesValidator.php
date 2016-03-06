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
class NotTwoMainAddressesValidator extends ConstraintValidator
{
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Validator\ConstraintValidatorInterface::validate()
	 */
	public function validate($addresses, Constraint $constraint)
	{
		$main_found = false;
		
		foreach($addresses as $address) {

			if ( false === $main_found && $address->getIsMain() == true ) {
				$main_found = true;
			} elseif ( true === $main_found && $address->getIsMain() == true ) {
				$this->context->addViolation($constraint->message);
			}
		}
	}
}