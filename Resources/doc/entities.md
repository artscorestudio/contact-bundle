# Bundle's entities

ContactBundle allows you to create and manage contacts like an address book. As you will see, there are not entities that can be directly persisted in this bundle. This bundle provides a model that you can use. So, apart of the class *IdentityModel*, the bundle provides interfaces.

So, for persistance of the entities, you have to create your own bundle who inherit from ContactBundle.

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

## IdentityModel and IdentityInterface

You have an abstract class on the top of the hierarchy : *IdentityModel* :

```php
<?php
// @ASFContactBundle/Model/Identity/IdentityModel.php
namespace ASF\ContactBundle\Model\Identity;

abstract class IdentityModel implements IdentityInterface { // [...] }
```

As you can see, this class implements *IdentityInterface*. If you do not use this class, ensure that your entities implement this interface. This interface ensures that your entity may use forms and other services from the bundle. It define the class properties used for relations between bundle's entities.

```php
<?php
// @ASFContactBundle/Model/Identity/IdentityInterface.php
namespace ASF\ContactBundle\Model\Identity;

interface IdentityInterface
{
	/**
	 * @return string
	 */
	public function getName();
	
	/**
	 * @param string $name
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function setName($name);
	
	/**
	 * @return \ASF\ContactBundle\Model\Identity\IdentityAccountInterface
	 */
	public function getAccount();
	
	/**
	 * @param \ASF\ContactBundle\Model\Identity\IdentityAccountInterface $account
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function setAccount(IdentityAccountInterface $account);
	
	/**
	 * Returns the organization to which the identity belongs
	 *
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getOrganizations();
	
	/**
	 * Add organization to the identity's organizations list
	 *
	 * @param mixed $organization
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function addOrganization($organization);
	
	/**
	 * Remove organization to the identity's organizations list
	 *
	 * @param mixed $organization
	 * @return \ASF\ContactBundle\Model\Identity\IdentityInterface
	 */
	public function removeOrganization($organization);
}
```

## PersonInterface and OrganizationInterface

Two classes can inherit from *IdentityModel* : a classe implementing *PersonInterface* and a class implementing *OrganizationInterface*. A Person is a human entity in real world and an Organization is a non physical entity. If you want to use this schema, you have to create on a bundle inherited from ContactBundle :

```php
<?php
// @AcmeDemoBundle/Entity/Identity.php
namespace Acme\DemoBundle\Entity;

use ASF\ContactBundle\Model\Identity\IdentityModel;

class Identity extends IdentityModel {}
```

```php
<?php
// @AcmeDemoBundle/Entity/Person.php
namespace Acme\DemoBundle\Entity;

use ASF\ContactBundle\Model\Person\PersonInterface;

class Person extends Identity implements PersonInterface {}
```

```php
<?php
// @AcmeDemoBundle/Entity/Organization.php
namespace Acme\DemoBundle\Entity;

use ASF\ContactBundle\Model\Person\OrganizationInterface;

class Organization extends Identity implements OrganizationInterface {}
```

### Doctrine ORM

The bundle provides a set of *.orm.xml files for define schema in folder *@ASFContactBundle/Resources/config/doctrine-mapping*.

## Address and ContactDevice entities

These entities are not enabled by default because it is not necessarily required to use this information in any case. You can enable it in bundle's configuration. For more information about the bundle configuration, check [ASFContactBundle Configuration Reference](configuration.md).

### AddressModel and AddressInterface

```php
<?php
// @ASFContactBundle/Model/Address/AddressModel.php
namespace ASF\ContactBundle\Model\Address;

abstract class AddressModel implements AddressInterface { // [...] }
```

As you can see, this class implements *AddressInterface*. If you do not use this class, ensure that your entities implement this interface. This interface ensures that your entity may use forms and other services from the bundle. It define the class properties used for relations between bundle's entities.

```php
<?php
// @ASFContactBundle/Model/Address/AddressInterface.php
namespace ASF\ContactBundle\Model\Address;

interface AddressInterface
{
	/**
	 * Return identities linked to this address
	 * 
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getIdentities();
}
```

### Province and Region interfaces

The bundle provides ProvinceInterface and RegionInterface entities used by Forms for create addresses.

```php
<?php
// @ASFContactBundle/Model/Address/ProvinceInterface.php
namespace ASF\ContactBundle\Model\Address;

interface ProvinceInterface
{
    /**
     * @return string
     */
    public function getCode();
    
    /**
     * @param string $code
     * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
     */
    public function setCode($code);
    
    /**
     * @return string
     */
    public function getName();
    
    /**
     * @param string $name
     * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
     */
    public function setName($name);
    
    /**
     * @return \ASF\ContactBundle\Entity\Region
     */
    public function getRegion();
    
    /**
     * @param \ASF\ContactBundle\Model\Address\RegionInterface $region
     * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
     */
    public function setRegion($region);
    
    /**
     * @return string
     */
    public function getCountry();
    
    /**
     * @param string $country
     * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
     */
    public function setCountry($country);
}
```

```php
<?php
// @ASFContactBundle/Model/Address/RegionInterface.php
namespace ASF\ContactBundle\Model\Address;

interface RegionInterface
{
    /**
	 * @return string
	 */
	public function getCode();

	/**
	 * @param string $code
	 * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
	 */
	public function setCode($code);

	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @param string $name
	 * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
	 */
	public function setName($name);

	/**
	 * @return string
	 */
	public function getCountry();

	/**
	 * @param string $country
	 * @return \ASF\ContactBundle\Model\Address\ProvinceInterface
	 */
	public function setCountry($country);
}
```

> ContactBundle provides DataFixtures with all French *Départements* and French *Régions*.

### ContactDeviceModel and ContactDeviceInterface

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



