<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Utils\Manager;

use ASF\CoreBundle\Entity\Manager\ASFEntityManager;

/**
 * Generic Entity Manager for this bundle
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class DefaultEntityManager extends ASFEntityManager implements DefaultEntityManagerInterface {}