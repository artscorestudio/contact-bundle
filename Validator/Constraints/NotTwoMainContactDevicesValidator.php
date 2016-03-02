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

use ASF\ContactBundle\Model\ContactDevice\ContactDeviceModel;

/**
 * Constraints for check if we have just one main email address in identity entity for Contact Device Entities
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class NotTwoMainContactDevicesValidator extends ConstraintValidator
{
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Validator\ConstraintValidatorInterface::validate()
	 */
	public function validate($contact_devices, Constraint $constraint)
	{
		$found = array('email' => false, 'phone' => false, 'website' => false);
		
		foreach($contact_devices as $contact_device) {
			
			switch($contact_device->getContactDevice()->getType()) {
				case ContactDeviceModel::TYPE_EMAIL:
					if ( $contact_device->getIsMain() == true && $found['email'] == false ) {
						$found['email'] = true;
					} elseif ( $contact_device->getIsMain() == true && $found['email'] == true ) {
						$this->context->addViolation(sprintf($constraint->message, 'email addresses'));
					}
					break;
				case ContactDeviceModel::TYPE_PHONE:
					if ( $contact_device->getIsMain() == true && $found['phone'] == false ) {
						$found['phone'] = true;
					} elseif ( $contact_device->getIsMain() == true && $found['phone'] == true ) {
						$this->context->addViolation(sprintf($constraint->message, 'phone numbers'));
					}
					break;
				case ContactDeviceModel::TYPE_WEBSITE:
					if ( $contact_device->getIsMain() == true && $found['website'] == false ) {
						$found['website'] = true;
					} elseif ( $contact_device->getIsMain() == true && $found['website'] == true ) {
						$this->context->addViolation(sprintf($constraint->message, 'websites'));
					}
					break;
			}
		}
	}
}