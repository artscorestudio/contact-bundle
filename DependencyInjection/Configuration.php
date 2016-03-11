<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('asf_contact');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->booleanNode('enable_core_support')
                    ->defaultFalse()
                ->end()
                ->booleanNode('enable_select2_support')
                    ->defaultFalse()
                ->end()
                ->booleanNode('enable_contact_device')
                    ->defaultFalse()
                ->end()
                ->booleanNode('enable_address')
                    ->defaultFalse()
                ->end()
                ->scalarNode('form_theme')
                    ->defaultValue('ASFContactBundle:Form:fields.html.twig')
                ->end()
                
                ->append($this->addIdentityParameterNode())
                ->append($this->addPersonParameterNode())
                ->append($this->addOrganizationParameterNode())
                ->append($this->addAddressParameterNode())
                ->append($this->addContactDeviceParameterNode())
                ->append($this->addIdentityContactDeviceParameterNode())
                ->append($this->addIdentityOrganizationParameterNode())
                ->append($this->addIdentityAddressParameterNode())
                ->append($this->addProvinceParameterNode())
                ->append($this->addRegionParameterNode())
                ->append($this->addEmailAddressParameterNode())
                ->append($this->addWebsiteAddressParameterNode())
                ->append($this->addPhoneNumberParameterNode())
                ->append($this->addGeolocParameterNode())
                
            ->end();
        
        return $treeBuilder;
    }
    
    /**
     * Add Identity Entity Configuration
     */
    protected function addIdentityParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('identity');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\IdentityType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\IdentityType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
		    	->addDefaultsIfNotSet()
		    	->children()
			    	->scalarNode('type')
			    		->defaultValue('ASF\ContactBundle\Form\Type\IdentityType')
			    	->end()
			    	->scalarNode('name')
			    		->defaultValue('identity_type')
			    	->end()
			    	->arrayNode('validation_groups')
			    		->prototype('scalar')->end()
			    		->defaultValue(array("Default"))
			    	->end()
			    	->end()
		    	->end()
	    	->end()
    	;
    
    	return $node;
    }
    
    /**
     * Add Person Entity Configuration
     */
    protected function addPersonParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('person');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\PersonType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\PersonType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
		    	->addDefaultsIfNotSet()
		    	->children()
			    	->scalarNode('type')
			    		->defaultValue('ASF\ContactBundle\Form\Type\PersonType')
			    	->end()
			    	->scalarNode('name')
			    		->defaultValue('person_type')
			    	->end()
			    	->arrayNode('validation_groups')
			    		->prototype('scalar')->end()
			    		->defaultValue(array("Default"))
			    	->end()
			    	->end()
		    	->end()
	    	->end()
    	;
    
    	return $node;
    }
    
    /**
     * Add Organization Entity Configuration
     */
    protected function addOrganizationParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('organization');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\OrganizationType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\OrganizationType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
			    	->addDefaultsIfNotSet()
			    	->children()
				    	->scalarNode('type')
				    		->defaultValue('ASF\ContactBundle\Form\Type\OrganizationType')
				    	->end()
				    	->scalarNode('name')
				    		->defaultValue('organization_type')
				    	->end()
				    	->arrayNode('validation_groups')
				    		->prototype('scalar')->end()
				    		->defaultValue(array("Default"))
				    	->end()
			    	->end()
		    	->end()
	    	->end()
    	;
    
    	return $node;
    }
    
    /**
     * Add Address Entity Configuration
     */
    protected function addAddressParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('address');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\AddressType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\AddressType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
			    	->addDefaultsIfNotSet()
			    	->children()
				    	->scalarNode('type')
				    		->defaultValue('ASF\ContactBundle\Form\Type\AddressType')
				    	->end()
				    	->scalarNode('name')
				    		->defaultValue('address_type')
				    	->end()
				    	->arrayNode('validation_groups')
				    		->prototype('scalar')->end()
				    		->defaultValue(array("Default"))
				    	->end()
				    ->end()
		    	->end()
	    	->end()
    	;
    
    	return $node;
    }
    
    /**
     * Add ContactDevice Entity Configuration
     */
    protected function addContactDeviceParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('contact_device');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\ContactDeviceType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\ContactDeviceType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
			    	->addDefaultsIfNotSet()
			    	->children()
				    	->scalarNode('type')
				    		->defaultValue('ASF\ContactBundle\Form\Type\ContactDeviceType')
				    	->end()
				    	->scalarNode('name')
				    		->defaultValue('contact_device_type')
				    	->end()
				    	->arrayNode('validation_groups')
				    		->prototype('scalar')->end()
				    		->defaultValue(array("Default"))
				    	->end()
			    	->end()
		    	->end()
	    	->end()
    	;
    
    	return $node;
    }
    
    /**
     * Add IdentityContactDevice Entity Configuration
     */
    protected function addIdentityContactDeviceParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('identity_contact_device');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\IdentityContactDeviceType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\IdentityContactDeviceType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
		    	->addDefaultsIfNotSet()
		    	->children()
			    	->scalarNode('type')
			    		->defaultValue('ASF\ContactBundle\Form\Type\IdentityContactDeviceType')
			    	->end()
			    	->scalarNode('name')
			    		->defaultValue('identity_contact_device_type')
			    	->end()
			    	->arrayNode('validation_groups')
			    		->prototype('scalar')->end()
			    		->defaultValue(array("Default"))
			    	->end()
			    	->end()
		    	->end()
	    	->end()
    	;
    
    	return $node;
    }
    
    /**
     * Add IdentityOrganization Entity Configuration
     */
    protected function addIdentityOrganizationParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('identity_organization');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\IdentityOrganizationType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\IdentityOrganizationType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
		    	->addDefaultsIfNotSet()
		    	->children()
			    	->scalarNode('type')
			    		->defaultValue('ASF\ContactBundle\Form\Type\IdentityOrganizationType')
			    	->end()
			    	->scalarNode('name')
			    		->defaultValue('identity_organization_type')
			    	->end()
			    	->arrayNode('validation_groups')
			    		->prototype('scalar')->end()
			    		->defaultValue(array("Default"))
			    	->end()
			    	->end()
		    	->end()
	    	->end()
    	;
    	
    	return $node;
    }
    
    /**
     * Add IdentityAddress Entity Configuration
     */
    protected function addIdentityAddressParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('identity_address');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\IdentityAddressType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\IdentityAddressType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
			    	->addDefaultsIfNotSet()
			    	->children()
				    	->scalarNode('type')
				    		->defaultValue('ASF\ContactBundle\Form\Type\IdentityAddressType')
				    	->end()
				    	->scalarNode('name')
				    		->defaultValue('identity_address_type')
				    	->end()
				    	->arrayNode('validation_groups')
				    		->prototype('scalar')->end()
				    		->defaultValue(array("Default"))
				    	->end()
				    ->end()
		    	->end()
	    	->end()
    	;
    	 
    	return $node;
    }
    
    /**
     * Add Province Entity Configuration
     */
    protected function addProvinceParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('province');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\ProvinceType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\ProvinceType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
			    	->addDefaultsIfNotSet()
			    	->children()
				    	->scalarNode('type')
				    		->defaultValue('ASF\ContactBundle\Form\Type\ProvinceType')
				    	->end()
				    		->scalarNode('name')
				    	->defaultValue('province_type')
				    	->end()
				    	->arrayNode('validation_groups')
				    		->prototype('scalar')->end()
				    		->defaultValue(array("Default"))
				    	->end()
			    	->end()
		    	->end()
	    	->end()
    	;
    
    	return $node;
    }
    
    /**
     * Add Region Entity Configuration
     */
    protected function addRegionParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('region');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\RegionType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\RegionType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
			    	->addDefaultsIfNotSet()
			    	->children()
				    	->scalarNode('type')
				    		->defaultValue('ASF\ContactBundle\Form\Type\RegionType')
				    	->end()
				    	->scalarNode('name')
				    		->defaultValue('region_type')
				    	->end()
				    	->arrayNode('validation_groups')
				    		->prototype('scalar')->end()
				    		->defaultValue(array("Default"))
				    	->end()
				    ->end()
		    	->end()
	    	->end()
    	;
    
    	return $node;
    }
    
    /**
     * Add WebsiteAddress Entity Configuration
     */
    protected function addWebsiteAddressParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('website_address');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\WebsiteAddressType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\WebsiteAddressType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
			    	->addDefaultsIfNotSet()
			    	->children()
				    	->scalarNode('type')
				    		->defaultValue('ASF\ContactBundle\Form\Type\WebsiteAddressType')
				    	->end()
				    	->scalarNode('name')
				    		->defaultValue('website_address_type')
				    	->end()
				    	->arrayNode('validation_groups')
				    		->prototype('scalar')->end()
				    		->defaultValue(array("Default"))
				    	->end()
			    	->end()
		    	->end()
	    	->end()
    	;
    
    	return $node;
    }
    
    /**
     * Add EmailAddress Entity Configuration
     */
    protected function addEmailAddressParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('email_address');
    
    	$node
	    	->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\EmailAddressType")))
	    	->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\EmailAddressType")))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
			    	->addDefaultsIfNotSet()
			    	->children()
				    	->scalarNode('type')
				    		->defaultValue('ASF\ContactBundle\Form\Type\EmailAddressType')
				    	->end()
				    		->scalarNode('name')
				    	->defaultValue('email_address_type')
				    	->end()
				    	->arrayNode('validation_groups')
				    		->prototype('scalar')->end()
				    		->defaultValue(array("Default"))
				    	->end()
			    	->end()
		    	->end()
	    	->end()
    	;
    
    	return $node;
    }
    
    /**
     * Add EmailAddress Entity Configuration
     */
    protected function addPhoneNumberParameterNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('phone_number');
    
        $node
            ->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\PhoneNumberType")))
            ->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\PhoneNumberType")))
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('type')
                            ->defaultValue('ASF\ContactBundle\Form\Type\PhoneNumberType')
                        ->end()
                        ->scalarNode('name')
                            ->defaultValue('phone_number_type')
                        ->end()
                        ->arrayNode('validation_groups')
                            ->prototype('scalar')->end()
                            ->defaultValue(array("Default"))
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    
        return $node;
    }
    
    /**
     * Add EmailAddress Entity Configuration
     */
    protected function addGeolocParameterNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('geoloc');
    
        $node
            ->treatTrueLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\GeolocType")))
            ->treatFalseLike(array('form' => array('type' => "ASF\ContactBundle\Form\Type\GeolocType")))
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('type')
                            ->defaultValue('ASF\ContactBundle\Form\Type\GeolocType')
                        ->end()
                            ->scalarNode('name')
                        ->defaultValue('geoloc_type')
                        ->end()
                        ->arrayNode('validation_groups')
                            ->prototype('scalar')->end()
                            ->defaultValue(array("Default"))
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    
        return $node;
    }
}
