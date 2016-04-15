# How to use Address entity and ContactDevice entity

## Enable Address Entity
If you want to use Address entity in your identity forms, you have to create an entity in your inherited bundle.

### Address Entity
```php
// @Acme/ContactBundle/Entity/Address.php
namespace Acme\ContactBundle\Entity;

use ASF\ContactBundle\Model\Address\AddressModel;

class Address extends AddressModel {}
```

You can have an example of Doctrine mapping in XML file in ASFContactBundle [Resources/config/doctrine-mapping/Address.orm.xml][1].

Don't forget to create an entity for the relation between Identity Entity and Address Entity :

```php
// @Acme/ContactBundle/Entity/IdentityAddress.php
namespace Acme\ContactBundle\Entity;

use ASF\ContactBundle\Model\Identity\IdentityInterface;
use ASF\ContactBundle\Model\Address\AddressInterface;

class IdentityAddress { //[...] }
```

You can have an example of Doctrine mapping in XML file in ASFContactBundle [Resources/config/doctrine-mapping/IdentityAddress.orm.xml][2].

### Region and Province Entities

If you want to manage Region and Province in your form, you can use Region and Province entities.

```php
// @Acme/ContactBundle/Entity/Region.php
namespace Acme\ContactBundle\Entity;

use ASF\ContactBundle\Model\Address\RegionInterface;

class Region implements RegionInterface { // [...] } 
```

You can have an example of Doctrine mapping in XML file in ASFContactBundle [Resources/config/doctrine-mapping/Region.orm.xml][3].

```php
// @Acme/ContactBundle/Entity/Province.php
namespace Acme\ContactBundle\Entity;

use ASF\ContactBundle\Model\Address\ProvinceInterface;

class Province implements ProvinceInterface { // [...] } 
```

You can have an example of Doctrine mapping in XML file in ASFContactBundle [Resources/config/doctrine-mapping/Province.orm.xml][4].

### Enable Address in ASFContactBundle

After the update of your Doctrine schema, don't forget to enable Address entity in bundle configuration :

```yaml
asf_contact:
    enable_address: true
```

### Override container parameters

All entities are stored in container parameters. This is for avoid to hardcoded entity names in classes. After the creation of your entities, you have to override container parameters. 

```xml
<?xml version="1.0" ?>

<container xmlns="http://symfony.com/schema/dic/services"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">

	<parameters>
		<parameter key="asf_contact.address.entity.class">Acme\ContactBundle\Entity\Address</parameter>
		<parameter key="asf_contact.province.entity.class">Acme\ContactBundle\Entity\Province</parameter>
		<parameter key="asf_contact.region.entity.class">Acme\ContactBundle\Entity\Region</parameter>
		<parameter key="asf_contact.identity_address.entity.class">Acme\ContactBundle\Entity\IdentityAddress</parameter>
    </parameters>

</container>
```

## ContactDevice Entity

### ContactDevice Entity

ContactDevices represents all means of contact an identity : email, phone, website, etc.

```php
<?php
// @ASFContactBundle/Model/ContactDevice/ContactDeviceModel.php
namespace ASF\ContactBundle\Model\ContactDevice;

abstract class ContactDeviceModel implements ContactDeviceInterface { // [...] }
```

As you can see, this class implements *ContactDeviceInterface*. If you do not use this class, ensure that your entities implement this interface. This interface ensures that your entity may use forms and other services from the bundle. It define the class properties used for relations between bundle's entities.

```php
<?php
// @ASFContactBundle/Model/ContactDevice/ContactDeviceInterface.php
namespace ASF\ContactBundle\Model\ContactDevice;

interface ContactDeviceInterface
{
	/**
	 * Return identities linked to this contact device
	 * 
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getIdentities();
}
```

#### Create Contact Devices based on ContractDeviceModel

##### EmailAddress

```php
<?php
// @AcmeDemoBundle/Entity/EmailAddress.php
namespace Acme\DemoBundle\Entity;

class EmailAddress extends ContactDeviceModel { }
```

##### PhoneNumber

```php
<?php
// @AcmeDemoBundle/Entity/PhoneNumber.php
namespace Acme\DemoBundle\Entity;

class PhoneNumber extends ContactDeviceModel { }
```

##### WebsiteAddress

```php
<?php
// @AcmeDemoBundle/Entity/WebsiteAddress.php
namespace Acme\DemoBundle\Entity;

class WebsiteAddress extends ContactDeviceModel { }
```

### Enable ContactDevice in ASFContactBundle

After the update of your Doctrine schema, don't forget to enable ContactDevice entity in bundle configuration :

```yaml
asf_contact:
    enable_contact_device: true
```

### Override container parameters

All entities are stored in container parameters. This is for avoid to hardcoded entity names in classes. After the creation of your entities, you have to override container parameters. 

```xml
<?xml version="1.0" ?>

<container xmlns="http://symfony.com/schema/dic/services"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">

	<parameters>
		<parameter key="asf_contact.contact_device.entity.class">Acme\ContactBundle\Entity\ContactDevice</parameter>
		<parameter key="asf_contact.email_address.entity.class">Acme\ContactBundle\Entity\EmailAddress</parameter>
		<parameter key="asf_contact.phone_number.entity.class">Acme\ContactBundle\Entity\PhoneNumber</parameter>
		<parameter key="asf_contact.website_address.entity.class">Acme\ContactBundle\Entity\WebsiteAddress</parameter>
		<parameter key="asf_contact.identity_contact_device.entity.class">Acme\ContactBundle\Entity\IdentityContactDevice</parameter>

</container>
```

[1]: ../config/doctrine-mapping/Address.orm.xml
[2]: ../config/doctrine-mapping/IdentityAddress.orm.xml
[3]: ../config/doctrine-mapping/Region.orm.xml
[4]: ../config/doctrine-mapping/Province.orm.xml