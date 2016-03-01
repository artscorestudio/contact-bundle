<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) 2012-2015 Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\ContactBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ASFContactExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
	    $config = $this->processConfiguration($configuration, $configs);
	    
	    $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
	    $loader->load('services/services.xml');
    }
}
