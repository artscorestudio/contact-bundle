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
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

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
	    
	    $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
	    
	    $this->setIdentityParameters($container, $loader, $config);
	    $this->setPersonParameters($container, $loader, $config);
	    $this->setOrganizationParameters($container, $loader, $config);
	    $this->setAddressParameters($container, $loader, $config);
	    $this->setContactDeviceParameters($container, $loader, $config);
	    
        $loader->load('services/services.yml');
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

        $this->configureTwigBundle($container, $config);
    }
    
    /**
     * Set Identity Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader   $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setIdentityParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['identity']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.identity.entity parameter must be defined.');
        }
       
        $container->setParameter('asf_contact.identity.entity', $config['identity']['entity']);
        $container->setParameter('asf_contact.identity.form.name', $config['identity']['form']['name']);
	    $container->setParameter('asf_contact.identity.form.type', $config['identity']['form']['type']);
    }
    
    /**
     * Set Person Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader   $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setPersonParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['person']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.person.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.person.entity', $config['person']['entity']);
        $container->setParameter('asf_contact.person.form.name', $config['person']['form']['name']);
        $container->setParameter('asf_contact.person.form.type', $config['person']['form']['type']);
    }
    
    /**
     * Set Organization Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader   $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setOrganizationParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['organization']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.organization.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.organization.entity', $config['organization']['entity']);
        $container->setParameter('asf_contact.organization.form.name', $config['organization']['form']['name']);
        $container->setParameter('asf_contact.organization.form.type', $config['organization']['form']['type']);
        
        if (null === $config['identity_organization']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.identity_organization.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.identity_organization.entity', $config['identity_organization']['entity']);
        $container->setParameter('asf_contact.identity_organization.form.name', $config['identity_organization']['form']['name']);
        $container->setParameter('asf_contact.identity_organization.form.type', $config['identity_organization']['form']['type']);
    }
    
    /**
     * Set Address Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader    $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setAddressParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        $container->setParameter('asf_contact.enable_address', $config['enable_address']);
        
        if ( !isset($config['enable_address']) || $config['enable_address'] === false ) {
            return;
        }
        
        if (null === $config['address']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.address.entity parameter must be defined.');
        }
        
        $container->setParameter('asf_contact.address.entity', $config['address']['entity']);
        $container->setParameter('asf_contact.address.form.name', $config['address']['form']['name']);
        $container->setParameter('asf_contact.address.form.type', $config['address']['form']['type']);
         
        if (null === $config['identity_address']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.identity_address.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.identity_address.entity', $config['identity_address']['entity']);
        $container->setParameter('asf_contact.identity_address.form.name', $config['identity_address']['form']['name']);
        $container->setParameter('asf_contact.identity_address.form.type', $config['identity_address']['form']['type']);
        
        $this->setProvinceParameters($container, $loader, $config);
        $this->setRegionParameters($container, $loader, $config);
        $this->setGeolocParameters($container, $loader, $config);
        
        $loader->load('services/address.yml');
    }
    
    /**
     * Set ContactDevice Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader    $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setContactDeviceParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        $container->setParameter('asf_contact.enable_contact_device', $config['enable_contact_device']);
        
        if ( !isset($config['enable_contact_device']) || $config['enable_contact_device'] === false ) {
            return;
        }
        if (null === $config['contact_device']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.contact_device.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.contact_device.entity', $config['contact_device']['entity']);
        $container->setParameter('asf_contact.contact_device.form.name', $config['contact_device']['form']['name']);
        $container->setParameter('asf_contact.contact_device.form.type', $config['contact_device']['form']['type']);
        
        if (null === $config['identity_contact_device']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.identity_contact_device.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.identity_contact_device.entity', $config['identity_contact_device']['entity']);
        $container->setParameter('asf_contact.identity_contact_device.form.name', $config['identity_contact_device']['form']['name']);
        $container->setParameter('asf_contact.identity_contact_device.form.type', $config['identity_contact_device']['form']['type']);
        
        $this->setWebsiteParameters($container, $loader, $config);
        $this->setEmailParameters($container, $loader, $config);
        $this->setPhoneNumberParameters($container, $loader, $config);
        
        $loader->load('services/contact_device.yml');
    }
    
    /**
     * Set Province Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader    $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setProvinceParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['province']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.province.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.province.entity', $config['province']['entity']);
        $container->setParameter('asf_contact.province.form.name', $config['province']['form']['name']);
        $container->setParameter('asf_contact.province.form.type', $config['province']['form']['type']);
    }
    
    /**
     * Set Region Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader    $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setRegionParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['region']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.region.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.region.entity', $config['region']['entity']);
        $container->setParameter('asf_contact.region.form.name', $config['region']['form']['name']);
        $container->setParameter('asf_contact.region.form.type', $config['region']['form']['type']);
    }
    
    /**
     * Set Website Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader    $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setWebsiteParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['website_address']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.website_address.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.website_address.entity', $config['website_address']['entity']);
        $container->setParameter('asf_contact.website_address.form.name', $config['website_address']['form']['name']);
        $container->setParameter('asf_contact.website_address.form.type', $config['website_address']['form']['type']);
    }
    
    /**
     * Set Email Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader    $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setEmailParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['email_address']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.email_address.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.email_address.entity', $config['email_address']['entity']);
        $container->setParameter('asf_contact.email_address.form.name', $config['email_address']['form']['name']);
        $container->setParameter('asf_contact.email_address.form.type', $config['email_address']['form']['type']);
    }
    
    /**
     * Set Phone Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader    $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setPhoneNumberParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['phone_number']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.phone_number.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.phone_number.entity', $config['phone_number']['entity']);
        $container->setParameter('asf_contact.phone_number.form.name', $config['phone_number']['form']['name']);
        $container->setParameter('asf_contact.phone_number.form.type', $config['phone_number']['form']['type']);
    }
    
    /**
     * Set Phone Entity Parameters in Container.
     *
     * @param ContainerBuilder $container
     * @param YamlFileLoader    $loader
     * @param array            $config
     *
     * @throws InvalidConfigurationException
     */
    protected function setGeolocParameters(ContainerBuilder $container, YamlFileLoader $loader, array $config)
    {
        if (null === $config['geoloc']['entity']) {
            throw new InvalidConfigurationException('The asf_contact.geoloc.entity parameter must be defined.');
        }
         
        $container->setParameter('asf_contact.geoloc.entity', $config['geoloc']['entity']);
        $container->setParameter('asf_contact.geoloc.form.name', $config['geoloc']['form']['name']);
        $container->setParameter('asf_contact.geoloc.form.type', $config['geoloc']['form']['type']);
    }
    
    /**
     * Configure twig bundle.
     *
     * @param ContainerBuilder $container
     * @param array            $config
     */
    public function configureTwigBundle(ContainerBuilder $container, array $config)
    {
        foreach (array_keys($container->getExtensions()) as $name) {
            switch ($name) {
                case 'twig':
                    // Add Form Theme
                    $container->prependExtensionConfig($name, array(
                        'form_themes' => array($config['form_theme']),
                    ));
                    break;
            }
        }
    }
}
