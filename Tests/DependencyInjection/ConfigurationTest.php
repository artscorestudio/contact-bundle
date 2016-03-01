<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\Tests\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use ASF\ContactBundle\DependencyInjection\Configuration;

/**
 * This test case check if the default bundle's configuration from bundle's Configuration class is OK
 *  
 * @author Nicolas Claverie <info@artscore-studio.fr
 *
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Processes an array of configurations.
	 * 
	 * @param array $configs An array of configuration items to process
	 * 
	 * @return array The processed configuration
	 */
	public function process($configs)
	{
		$processor = new Processor();
		return $processor->processConfiguration(new Configuration(), $configs);
	}
}