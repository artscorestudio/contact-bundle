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

use \Mockery as m; 
use ASF\ContactBundle\DependencyInjection\ASFContactExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Bundle's Extension Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFContactExtensionTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var \ASF\ContactBundle\DependencyInjection\ASFContactExtension
	 */
	protected $extension;
	
	/**
	 * {@inheritDoc}
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp()
	{
		parent::setUp();

		$this->extension = new ASFContactExtension();
	}
	
	/**
	 * @covers ASF\ContactBundle\DependencyInjection\ASFContactExtension::load
	 */
	public function testLoadExtension()
	{
		$this->extension->load(array(), $this->getContainer());
	}
	
	/**
	 * @covers ASF\ContactBundle\DependencyInjection\ASFContactExtension::prepend
	 */
	public function testPrependExtension()
	{
	    $this->extension->prepend($this->getContainer());
	}
	
	/**
	 * Return a mock object of ContainerBuilder
	 * 
	 * @return \Symfony\Component\DependencyInjection\ContainerBuilder
	 */
	protected function getContainer($bundles = null, $extensions = null)
	{
	    $bag = m::mock('Symfony\Component\DependencyInjection\ParameterBag\ParameterBag');
	    $bag->shouldReceive('add');
	    
	    if ( is_null($bundles) ) {
    	    $bundles = $bundles = array(
    	        'TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle',
    	    );
	    }
	    
	    if ( is_null($extensions) ) {
    	    $extensions = array(
    	        'twig' => array()
    	    );
	    }
	    
	    $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
	    $container->shouldReceive('getParameter')->with('kernel.bundles')->andReturn($bundles);
	    $container->shouldReceive('getExtensions')->andReturn($extensions);
	    $container->shouldReceive('getExtensionConfig')->andReturn(array());
	    $container->shouldReceive('prependExtensionConfig');
	    $container->shouldReceive('setAlias');
	    
	    $container->shouldReceive('addResource');
	    $container->shouldReceive('setParameter');
	    $container->shouldReceive('hasExtension')->andReturn(false);
	    $container->shouldReceive('getParameterBag')->andReturn($bag);
	    $container->shouldReceive('setDefinition');
	    $container->shouldReceive('setParameter');
	    
	    return $container;
	}
	
	/**
	 * Return bundle's default configuration
	 * 
	 * @return array
	 */
	protected function getDefaultConfig()
	{
	    return array(
	        
	    );
	}
}