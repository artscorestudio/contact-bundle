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
 * Constraints for check if identity already exists based on name attribute
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class IdentityAlreadyExists extends Constraint
{
    /**
     * @var string
     */
    public $message = "asf.contact.form.identity.already_exists";
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Validator\Constraint::getTargets()
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}