# Artscore Studio Contact Bundle

Contact Bundle is a Symfony 2/3 bundle for create and manage contacts in your Symfony 2/3 application. This package is a part of Artscore Studio Framework.

> IMPORTANT NOTICE: This bundle is still under development. Any changes will be done without prior notice to consumers of this package. Of course this code will become stable at a certain point, but for now, use at your own risk.
 
## Prerequisites

This version of the bundle requires :
* [Symfony 2.8+ LTS / 3+][1]

### Translations

If you wish to use default texts provided in this bundle, you have to make sure you have translator enabled in your config.

```yaml
# app/config/config.yml
framework:
    translator: ~
```

For more information about translations, check [Symfony documentation][2].

## Installation

### Step 1 : Download ASFContactBundle using composer

Require the bundle with composer :

```bash
$ composer require artscorestudio/contact-bundle
```

Composer will install the bundle to your project's *vendor/artscorestudio/contact-bundle* directory. It also install dependencies. 

### Step 2 : Enable the bundle and its dependencies

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
    enable_address: true         # Default : false. Enable Address entity
    enable_contact_device: true  # Default : false. Enable ContactDevice entity
```

For more information about the bundle configuration, check [ASFContactBundle Configuration Reference][3].

### Step 4 : Import ASFContactBundle routes

```yaml
# app/config/routing.yml
asf_contact:
    resource: "@ASFContactBundle/Resources/config/routing.yml"
```

### Step 5 : Extends the bundle

ContactBundle is an *abstract* bundle. You have to create an inherited bundle if you want to persist entities :

```php
<?php
namespace Acme\ContactBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeContactBundle extends Bundle
{
	public function getParent()
	{
		return 'ASFContactBundle';
	}
}
```

For more information about bundle inheritance, check [Symfony documentation][4].

### Step 6 : Create your entity classes

The goal of this bundle is to manage contacts, so you have to create your contact entities according to your needs and persist it in a database. For a complete explanation of entities in ASFContactBundle, see [Using ASFContactBundle entities][7] in this documentation.

> Don't forget, *ASFContactBundle* provides one abtract class *IdentityModel* that you can extends and who define a set of generic attributes like (name, email, etc.) but Person, Organization and IdentityOrganization entities must implements interfaces *PersonInterface*, *OrganizationInterface* and *IdentityOrganizationInterface* for a correct use of the bundle.

#### 6.1 Create Identity entity in your bundle

```php
// Acme/ContactBundle/Entity
namespace Acme\ContactBundle\Entity;

use ASF\ContactBundle\Model\Identity\IdentityModel;

class Identity extends IdentityModel {}
```

Don't forget to define entity for Doctrine ORM, see [Identity.orm.xml][13] example file provided by this bundle.

#### 6.2 Create Person entity in your bundle

```php
// Acme/ContactBundle/Entity
namespace Acme\ContactBundle\Entity;

use ASF\ContactBundle\Model\Person\PersonInterface;

class Person extends Identity implements PersonInterface {}
```

Don't forget to define entity for Doctrine ORM, see [Person.orm.xml][14] example file provided by this bundle.

> A Person Entity is composed by a firstname and a lastname and an Identity Entity extended by Person entity is composed by a name attribute which cannot be null. Similarly, the type attribute must be defined (Person or Organization). So when you create/update a Person entity don't forget to fill in the name attribute with the firstname and lastname and update the type attribute. [You can do it with preUpdate, prePersist Doctrine Events if you want][20]. 

#### 6.3 Create Organization entity in your bundle

```php
// Acme/ContactBundle/Entity
namespace Acme\ContactBundle\Entity;

use ASF\ContactBundle\Model\Person\OrganizationInterface;

class Organization extends Identity implements OrganizationInterface {}
```

Don't forget to define entity for Doctrine ORM, see [Organization.orm.xml][15] example file provided by this bundle.

#### 6.3 Create IdentityOrganization entity in your bundle

This entity represent the relation between an Identity and an Organization.

```php
// Acme/ContactBundle/Entity
namespace Acme\ContactBundle\Entity;

use ASF\ContactBundle\Model\Person\OrganizationInterface;

class IdentityOrganization implements IdentityOrganizationInterface {}
```

Don't forget to define entity for Doctrine ORM, see [IdentityOrganization.orm.xml][16] example file provided by this bundle.

#### 6.4 Update container arguments

All entities are stored in container parameters. This is for avoid to hardcoded entity names in classes. After the creation of your entities, you have to set container parameters. 

```yaml
asf_contact:
    identity:
        entity: Acme\ContactBundle\Entity\Identity
    person:
        entity: Acme\ContactBundle\Entity\Person
    organization:
        entity: Acme\ContactBundle\Entity\Organization
    identity_organization:
        entity: Acme\ContactBundle\Entity\IdentityOrganization
    address:
        entity: Acme\ContactBundle\Entity\Address
    identity_address:
        entity: Acme\ContactBundle\Entity\IdentityAddress
    region:
        entity: Acme\ContactBundle\Entity\Region
    province:
        entity: Acme\ContactBundle\Entity\Province
    contact_device:
        entity: Acme\ContactBundle\Entity\ContactDevice
    email_address:
        entity: Acme\ContactBundle\Entity\EmailAddress
    phone_number:
        entity: Acme\ContactBundle\Entity\PhoneNumber
    website_address:
        entity: Acme\ContactBundle\Entity\WebsiteAddress
    identity_contact_device:
        entity: Acme\ContactBundle\Entity\IdentityContactDevice
```

#### 6.5 Update your schema

You have to update your schema by fire the following command :

```bash
$ php bin/console doctrine:schema:update --force
```

### Next Steps

Now you have completed the basic installation and configuration of the ASFContactBundle, you are ready to learn about more advanced features and usages of the bundle.

The following documents are available :
* [Overriding default ASFContactBundle Templates][5]
* [Overriding Default ASFContactBundle Forms][6]
* [ASFContactBundle Entity Repositories][8]
* [ASFContactBundle embedded Entity Manager][9]
* [ASFContactBundle Configuration Reference][3]
* [How to use ASFContactBundle CRUD System][10]
* [How to use Address entity and ContactDevice Entity][21]

[1]: http://symfony.com/download
[2]: https://symfony.com/doc/current/book/translation.html
[3]: configuration.md
[4]: http://symfony.com/doc/current/cookbook/bundles/inheritance.html
[5]: templates.md
[6]: forms.md
[7]: entities.md
[8]: repositories.md
[9]: entity-manager.md
[10]: crud-system.md
[12]: https://github.com/APY/APYDataGridBundle
[13]: ../config/doctrine-mapping/Identity.orm.xml
[14]: ../config/doctrine-mapping/Person.orm.xml
[15]: ../config/doctrine-mapping/Organization.orm.xml
[16]: ../config/doctrine-mapping/IdentityOrganization.orm.xml
[18]: https://github.com/artscorestudio/core-bundle/blob/master/Resources/doc/index.md
[19]: https://github.com/artscorestudio/APYDataGridBundle/blob/master/Resources/doc/index.md
[20]: http://doctrine-orm.readthedocs.org/projects/doctrine-orm/en/latest/reference/events.html
[21]: enable-extra-entities.md