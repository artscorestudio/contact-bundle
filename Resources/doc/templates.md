# Overriding default ASFContactBundle Templates

As you start to incorporate ASFContactBundle into your application, you will probably find that you need to override the default templates that are provided by the bundle. Although the template names are not configurable, the Symfony framework provides two ways to override the templates of a bundle.

* Define a new template of the same name in the app/Resources directory
* Create a new bundle that is defined as a child of ASFContactBundle

## Example: Overriding The Default layout.html.twig

It is highly recommended that you override the Resources/views/layout.html.twig template so that the pages provided by the ASFContactBundle have a similar look and feel to the rest of your application. An example of overriding this layout template is demonstrated below using both of the overriding options listed above.

Here is the default layout.html.twig provided by the ASFContactBundle :

```django
{% extends "::base.html.twig" %}

{% block title %}
	{% block asf_base_meta_title %}{% endblock %}
{% endblock %}

{% block body %}

	{% block breadcrumbs_tree %}{% endblock %}

	<h1>{% block page_title %}ASFContactBundle{% endblock %}</h1>

	{% block asf_cmd_buttons %}{% endblock %}

	{% block content %}{% endblock %}

{% endblock body %}
```

As you can see its pretty basic and doesn't really have much structure, so you will want to replace it with a layout file that is appropriate for your application.

### Define New Template In app/Resources

The easiest way to override a bundle's template is to simply place a new one in your app/Resources folder. To override the layout template located at Resources/views/layout.html.twig in the ASFContactBundle directory, you would place your new layout template at app/Resources/ASFContactBundle/views/layout.html.twig.

### Create A Child Bundle And Override Template

This method is more complicated than the one outlined above. Unless you are planning to override the controllers as well as the templates, it is recommended that you use the other method.

As listed above, you can also create a bundle defined as child of ASFContactBundle and place the new template in the same location that is resides in the ASFContactBundle. The first thing you want to do is override the getParent method to your bundle class.

```php
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

By returning the name of the bundle in the getParent method of your bundle class, you are telling the Symfony Framework that your bundle is a child of the ASFContactBundle.

Now that you have declared your bundle as a child of the ASFContactBundle, you can override the parent bundle's templates. To override the layout template, simply create a new file in the src/Acme/DemoBundle/Resources/views directory named layout.html.twig. Notice how this file resides in the same exact path relative to the bundle directory as it does in the ASFContactBundle.

After overriding a template in your child bundle, you must clear the cache for the override to take effect, even in a development environment.

Overriding all of the other templates provided by the ASFContactBundle can be done in a similar fashion using either of the two methods shown in this document.
