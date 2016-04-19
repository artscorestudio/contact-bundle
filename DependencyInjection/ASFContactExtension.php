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

use ASF\CoreBundle\DependencyInjection\ASFExtension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ASFContactExtension extends ASFExtension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
	    $config = $this->processConfiguration($configuration, $configs);
	    
	    $this->mapsParameters($container, $this->getAlias(), $config);
	    
	    $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

	    $container->setParameter('asf_contact.enable_address', $config['enable_address']);
	    $container->setParameter('asf_contact.enable_contact_device', $config['enable_contact_device']);

        $loader->load('services/services.xml');
        $loader->load('services/identity.xml');
        $loader->load('services/person.xml');
        $loader->load('services/organization.xml');
        
        if ( isset($config['enable_address']) && $config['enable_address'] === true ) {
            $loader->load('services/address.xml');
        }
         
        if ( isset($config['enable_contact_device']) && $config['enable_contact_device'] === true ) {
            $loader->load('services/contact_device.xml');
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
    
        $container->setParameter('asf_contact.enable_asf_layout', $container->hasExtension('asf_layout'));

        $this->configureTwigBundle($container, $config);
    }
}
