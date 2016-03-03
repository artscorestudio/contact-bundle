# ASFContactBundle embedded Entity Manager

If you want to use ContactBundle has standalone bundle, you have to know its particularities :

## The bundle's entities

All entities are managed throught their corresponding Entity Managers. This allows to build forms without an hardcoded dependency. For example, the entity *Person* have a form *IdentityType*. Without ENtity Manager, we pass the entity class name like this :

```php
<?php
namespace ASF\ContactBundle\Form\Type;

class PersonType extends AbstractType
{
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'ASF\ContactBundle\Entity\Person',
			'translation_domain' => 'asf_contact',
			'is_new' => false
		));
	}
}
```

But the ContactBundle provides you models for your entities but it is not possible to persist entities in vendor. So, you have to change the data_class parameter. The example below is one of ways for do this. Whatever the way you take, you have to recode a part of the bundle.

```php
<?php
namespace Acme\DemoBundle\Form\Type;

use ASF\ContactBundle\Form\Type\PersonFormType as BaseFormType;

class PersonType extends BasePersonType
{
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Acme\DemoBundle\Entity\Person',
			'translation_domain' => 'asf_contact',
			'is_new' => false
		));
	}
}
```

To avoid rewriting everything, and for a quick start to use bundle, the forms use Entity Managers :

```php
<?php
namespace Acme\DemoBundle\Form\Type;

use ASF\ContactBundle\Form\Type\PersonFormType as BaseFormType;
use ASF\ContactBundle\Entity\Manager\ASFContactEntityManagerInterface;

class PersonType extends BasePersonType
{
	/**
     * @param ASFContactEntityManagerInterface $person_manager
     */
    public function __construct(ASFContactEntityManagerInterface $person_manager, EventSubscriberInterface $subscriber)
    {
        $this->personManager = $person_manager;
        $this->subscriber = $subscriber;
    }
    
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => $this->personManager->getClassName(),
			'translation_domain' => 'asf_contact',
			'is_new' => false
		));
	}
}
```

All entity managers provided in this bundle are based on [ASFEntityManager provided by ASFCoreBundle](https://github.com/artscorestudio/core-bundle/blob/master/Resources/doc/entity-manager.md). If you do not want to install ASFCoreBUndle, you have to create your own Entity Manager implementing the ASFContactEntityManagerInterface and overriding the Person Entity Manager class parameter.

### Default Person Entity Manager
```xml
<!-- @ASFContactBundle/Resources/config/services/asf_core_enabled/services.xml -->
<?xml version="1.0" ?>

<container xmlns="http://symfony.com/schema/dic/services"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">

	<parameters>
    	
    	<!-- Generic Entity Manager -->
    	<parameter key="asf_contact.entity.manager.class">ASF\ContactBundle\Entity\Manager\ASFContactEntityManager</parameter>

		<!-- Person Manager -->
		<parameter key="asf_contact.person.entity.class">ASF\ContactBundle\Entity\Person</parameter>
    	
    </parameters>

    <services>
    
        <!-- Person Entity Manager -->
        <service id="asf_contact.person.manager" class="%asf_contact.entity.manager.class%">
            <tag name="asf_core.manager" entity="%asf_contact.person.entity.class%" />
        </service>
        
    </services>
    
</container>
```

If you take a look on the parameter *asf_contact.entity.manager.class*, its default value is *ASF\ContactBundle\Entity\Manager\ASFContactEntityManager*) :

```php
<?php
namespace ASF\ContactBundle\Entity\Manager;

use ASF\CoreBundle\Entity\Manager\ASFEntityManager;

class ASFContactEntityManager extends ASFEntityManager implements ASFContactEntityManagerInterface {}
```

You can see that this default parameter implements *ASFContactEntityManagerInterface*, yours should be the same.

### Using defaults

If you use ContactBundle with its default configuration and services. When you extends the bundle and define persisted entities, you just have to override  *asf_contact.person.entity.class* with the name of your entity :

```xml
<!-- @AcmeDemoBundle/Resources/config/services.xml -->
<?xml version="1.0" ?>

<container xmlns="http://symfony.com/schema/dic/services"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">

	<parameters>

		<!-- Person Manager -->
		<parameter key="asf_contact.person.entity.class">Acme\DemoBundle\Entity\Person</parameter>
    	
    </parameters>
    
</container>
```

You can also do it in bundle extension class :

```php
<?php
<!-- @AcmeDemoBundle/DependencyInjection/AcmeDemoExtension.php -->
namespace Acme\DemoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AcmeDemoExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
	    $config = $this->processConfiguration($configuration, $configs);
		// [...]
	    $container->setParameter('asf_contact.person.entity.class', 'Acme\DemoBundle\Entity\Person');
	   // [...]
    }
}
```
