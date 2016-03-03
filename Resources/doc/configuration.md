# ASFContactBundle Configuration Reference

## Default configuration

```yaml
asf_contact:
    enable_core_support: false
    enable_select2_support: false
    enable_contact_device: false
    enable_address: false
    form_theme: "ASFContactBundle:Form:fields.html.twig"
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