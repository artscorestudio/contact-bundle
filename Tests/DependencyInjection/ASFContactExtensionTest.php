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

use ASF\ContactBundle\DependencyInjection\ASFContactExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Bundle\AsseticBundle\DependencyInjection\AsseticExtension;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;

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
	    $bag = $this->getMock('Symfony\Component\DependencyInjection\ParameterBag\ParameterBag');
		$bag->method('add');
		 
		if ( is_null($bundles) ) {
			$bundles = $bundles = array(
				'AsseticBundle' => 'Symfony\Bundle\AsseticBundle\AsseticBundle',
				'TwigBundle' => 'Symfony\Bundle\TwigBundle\TwigBundle'
			);
		}
		 
		if ( is_null($extensions) ) {
			$extensions = array(
				'assetic' => new AsseticExtension(),
				'twig' => new TwigExtension()
			);
		}
		
		$container = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');
		$container->method('getParameter')->with('kernel.bundles')->willReturn($bundles);
		$container->method('getExtensions')->willReturn($extensions);

		$container->method('getExtensionConfig')->willReturn(array());
		$container->method('prependExtensionConfig');
		$container->method('setAlias');
		$container->method('getExtension');
		 
		$container->method('addResource');
		$container->method('setParameter');
		$container->method('getParameterBag')->willReturn($bag);
		$container->method('setDefinition');
		$container->method('setParameter');
		
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
			'enable_core_support' => false,
	    	'enable_select2_support' => false,
	    	'enable_contact_device' => false,
	    	'enable_address' => false,
	    	'form_theme' => 'ASFContactBundle:Form:fields.html.twig',
			'identity' => array(
				'form' => array(
					'type' => "ASF\ContactBundle\Form\Type\IdentityType",
					'name' => 'identity_type'	
				)
			),
    		'person' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\PersonType",
    				'name' => 'person_type'
    			)
    		),
    		'organization' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\OrganizationType",
    				'name' => 'organization_type'
    			)
    		),
    		'address' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\AddressType",
    				'name' => 'address_type'
    			)
    		),
    		'contact_device' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\ContactDeviceType",
    				'name' => 'contact_device_type'
    			)
    		),
    		'identity_contact_device' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\IdentityContactDeviceType",
    				'name' => 'identity_contact_device_type'
    			)
    		),
    		'identity_organization' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\IdentityOrganizationType",
    				'name' => 'identity_organization_type'
    			)
    		),
    		'identity_address' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\IdentityAddressType",
    				'name' => 'identity_address_type'
    			)
    		),
    		'province' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\ProvinceType",
    				'name' => 'province_type'
    			)
    		),
    		'region' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\RegionType",
    				'name' => 'region_type'
    			)
    		),
    		'website_address' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\WebsiteAddressType",
    				'name' => 'website_address_type'
    			)
    		),
    		'email_address' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\EmailAddressType",
    				'name' => 'email_address_type'
    			)
    		),
    		'phone_number' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\PhoneNumberType",
    				'name' => 'phone_number_type'
    			)
    		),
    		'geoloc' => array(
    			'form' => array(
    				'type' => "ASF\ContactBundle\Form\Type\GeolocType",
    				'name' => 'geoloc_type'
    			)
    		)
		);
	}
}