<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Asf\Bundle\ContactBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;

/**
 * Data Fixture loader
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class loader extends DataFixtureLoader
{
	/**
	 * (non-PHPdoc)
	 * @see \Hautelook\AliceBundle\Alice\DataFixtureLoader::getFixtures()
	 */
	protected function getFixtures()
	{
		return array(
			//__DIR__ . '/Region.yml',
			//__DIR__ . '/Province.yml',
		);
	}
}