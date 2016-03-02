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

use Symfony\Component\Validator\Constraint;

/**
 * Constraints for check if we have just one main email address in identity entity for Contact Device Entities
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class NotTwoMainContactDevices extends Constraint
{
	public $message = "You can't have two main %s for a contact.";
}