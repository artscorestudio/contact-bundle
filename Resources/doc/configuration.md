# ASFContactBundle Configuration Reference

## Default configuration

```yaml
asf_contact:
    enable_core_support: false
    enable_select2_support: false
    enable_contact_device: false
    enable_address: false
    form_theme: "ASFContactBundle:Form:fields.html.twig"
    identity:
        form:
            type: "ASF\ContactBundle\Form\Type\IdentityType"
            name: "identity_type"
    person:
        form:
            type: "ASF\ContactBundle\Form\Type\PersonType"
            name: "person_type"
    organization:
        form:
            type: "ASF\ContactBundle\Form\Type\OrganizationType"
            name: "organization_type"
    identity_organization:
        form:
            type: "ASF\ContactBundle\Form\Type\IdentityOrganizationType"
            name: "identity_organization_type"
    address:
        form:
            type: "ASF\ContactBundle\Form\Type\AddressType"
            name: "address_type"
    contact_device:
        form:
            type: "ASF\ContactBundle\Form\Type\ContactDeviceType"
            name: "contact_device_type"
    identity_address:
        form:
            type: "ASF\ContactBundle\Form\Type\IdentityAddressType"
            name: "identity_address_type"
    identity_contact_device:
        form:
            type: "ASF\ContactBundle\Form\Type\IdentityContactDeviceType"
            name: "identity_contact_device_type"
    province:
        form:
            type: "ASF\ContactBundle\Form\Type\ProvinceType"
            name: "province_type"
    region:
        form:
            type: "ASF\ContactBundle\Form\Type\RegionType"
            name: "rregion_type"
    email_address:
        form:
            type: "ASF\ContactBundle\Form\Type\EmailAddressType"
            name: "email_address_type"
    website_address:
        form:
            type: "ASF\ContactBundle\Form\Type\WebsiteAddressType"
            name: "website_address_type"
```

### *enable_core_support* parameter

The *enable_core_support* is for use ASFContactBundle in the Artscore Studio Framework.

For more information about Artscore Studio Framework, check [ASFCoreBundle documentation](https://github.com/artscorestudio/core-bundle/blob/master/Resources/doc/framework.md).

### *enable_select2_support* parameter

If this is set to true, the form type *SearchIdentityType* display an autoincrement field for search identity in a form.

I suggest using [select2/select2](https://github.com/select2/select2) repository. You can add it by enter the follow command :

```bash
$ composer require select2/select2 "4.0.*"
```

Add it in your assets and call it in your templates :

{% stylesheets '@select2_css' %}
	<link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
{% endstylesheets %}


{% javascripts '@select2_js' %}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}

For a complete layout features, install [ASFLayoutBUndle](https://github.com/artscorestudio/layout-bundle).

### *enable_contact_device* parameter and *enable_address* parameter

No explanation needed for that. If you do not want to use addresses for identities. ContactDevices represents all means of contact an identity : email, phone, website, etc. For more information about Artscore Studio Framework, check [[Bundle's entities](entities.md).


### *form_theme* parameter

Use embedded form theme based on select2/select2 Jquery plugin and Twitter Bootstrap.

### Identity, and all other entities parameters

This parameters is for configurate forms for entities. If you want to customize forms according  to your needs, you can override forms without rewrite all the controllers or forms. For further information, check documentation on [overriding forms](forms.md).