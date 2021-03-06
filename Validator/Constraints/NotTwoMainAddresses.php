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

/**
 * Constraints for check if we have just one main address in identity entity
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class NotTwoMainAddresses extends Constraint
{
	public $message = "You can't have two main addresses for an identity.";
}