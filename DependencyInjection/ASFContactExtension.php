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

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ASFContactExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
	    $config = $this->processConfiguration($configuration, $configs);
	    
	    $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
	    $loader->load('services/forms/services.xml');

	    $container->setParameter('asf_contact.enable_address', $config['enable_address']);
	    $container->setParameter('asf_contact.enable_contact_device', $config['enable_contact_device']);
	    
	    if ( isset($config['enable_core_support']) && $config['enable_core_support'] === true ) {
	        $loader->load('services/asf_core_enabled/services.xml');
	        
	        if ( isset($config['enable_address']) && $config['enable_address'] === true ) {
	            $loader->load('services/asf_core_enabled/Address.xml');
	        }
	         
	        if ( isset($config['enable_contact_device']) && $config['enable_contact_device'] === true ) {
	            $loader->load('services/asf_core_enabled/ContactDevice.xml');
	        }
	    }
	    
	    if ( isset($config['enable_address']) && $config['enable_address'] === true ) {
	        $loader->load('services/forms/Address.xml');
	    }
	    
	    if ( isset($config['enable_contact_device']) && $config['enable_contact_device'] === true ) {
	        $loader->load('services/forms/ContactDevice.xml');
	    }
    }
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface::prepend()
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');
    
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);
    
        if ( $config['enable_select2_support'] == true )
            $this->configureTwigBundle($container, $config);
    
        if ( !array_key_exists('ASFCoreBundle', $bundles) && $config['enable_core_support'] == true )
            throw new InvalidConfigurationException('You have enabled the support of ASFCoreBundle but it is not enabled. Install it or disable ASFCoreBundle support in ASFUserBundle.');
    }
    
    /**
     * Configure twig bundle
     *
     * @param ContainerBuilder $container
     * @param array $config
     */
    public function configureTwigBundle(ContainerBuilder $container, array $config)
    {
        foreach(array_keys($container->getExtensions()) as $name) {
            switch($name) {
                case 'twig':
                    $container->prependExtensionConfig($name, array(
                        'form_themes' => array($config['form_theme'])
                    ));
                    break;
            }
        }
    }
}
