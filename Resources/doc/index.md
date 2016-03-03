# Artscore Studio Contact Bundle

Contact Bundle is a Symfony 2/3 bundle for create and manage contacts in your Symfony 2/3 application. This package is a part of Artscore Studio Framework.

> IMPORTANT NOTICE: This bundle is still under development. Any changes will be done without prior notice to consumers of this package. Of course this code will become stable at a certain point, but for now, use at your own risk.
 
## Prerequisites

This version of the bundle requires :
* Symfony 2.8+ / 3+

### Translations

If you wish to use default texts provided in this bundle, you have to make sure you have translator enabled in your config.

```yaml
# app/config/config.yml
framework:
    translator: ~
```

For more information about translations, check [Symfony documentation](https://symfony.com/doc/current/book/translation.html).

## Installation

### Step 1 : Download ASFContactBundle using composer

Require the bundle with composer :

```bash
$ composer require artscorestudio/contact-bundle "dev-master"
```

Composer will install the bundle to your project's *vendor/artscorestudio/contact-bundle* directory. It also install dependencies. 

### Step 2 : Enable the bundle

Enable the bundle in the kernel :

```php
// app/AppKernel.php

public function registerBundles()
{
	$bundles = array(
		// ...
		new ASF\ContactBundle\ASFContactBundle()
		// ...
	);
}
```

### Step 3 : Configure the bundle

If you want to use all the features provided by the bundle, you can configure it like the following :

```yaml
# app/config/config.yml
asf_contact:
    enable_core_support: true    # Default : false. This is for use bundle in the Artscore Studio Framework (needs ASFCoreBundle)
    enable_select2_support: true # Default : false. This is for use forms fields based on jQuery plugin select2/select2
    enable_address: true         # Default : false. Enable Address entity
    enable_contact_device: true  # Default : false. Enable ContactDevice entity
```

For more information about the bundle configuration, check [ASFContactBundle Configuration Reference](configuration.md).

### Step 4 : Import ASFContactBundle routes

```yaml
# app/config/routing.yml
asf_contact:
    resource: "@ASFContactBundle/Resources/config/routing.yml"
```

### Step 5 : Extends the bundle

ContactBundle is an *abstract* bundle. You have to create an inherited bundle :

```php
<?php
namespace Acme\DemoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeDemoBundle extends Bundle
{
	public function getParent()
	{
		return 'ASFContactBundle';
	}
}
```

For more information about bundle inheritance, check [Symfony documentation](http://symfony.com/doc/current/cookbook/bundles/inheritance.html).

### Next Steps

Now you have completed the basic installation and configuration of the ASFContactBundle, you are ready to learn about more advanced features and usages of the bundle.

The following documents are available :
* [Overriding default ASFContactBundle Templates](templates.md)
* [Bundle's entities](entities.md)
* [Entity Repositories](repositories.md)
* [ASFContactBundle embedded Entity Manager](entity-manager.md)
* [ASFContactBundle Configuration Reference](configuration.md)