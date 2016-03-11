# Overriding Default ASFContactBundle Forms

## Overriding a form type

The default forms packaged with the ASFContactBundle provide functionality for manage contacts. These forms work well with the bundle's default classes and controllers. But, as you start to add more properties to your classes or you decide you want to add a few options to the forms you will find that you need to override the forms in the bundle.

Suppose that you want to a birthday attribute in Person entity. You have to add this field in the Person form. The first step is to create your own Person Form who inherit from the ASFContactBundle PersonForm Type. 

```php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('birthday', DateType::class);
    }

    public function getParent()
    {
        return 'ASF\ContactBundle\Form\Type\PersonType';
    }

    public function getBlockPrefix()
    {
        return 'app_person_type';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
```

> If you don't want to reuse the fields added in ASFContactBundle by default, you can omit the getParent method and configure all fields yourself.

The second step is to declare your form as a service and add a tag to it. The tag must have a name value of form.type and an alias value that is the equal to the string returned from the getName method of your form type class. The alias that you specify is what you will use in the ASFContactBundle configuration to let the bundle know that you want to use your custom form.

```xml
<!-- app/config/services.xml -->
<?xml version="1.0" encoding="UTF-8" ?>

<container xmlns="http://symfony.com/schema/dic/services"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">

    <services>

        <service id="app.form.person" class="AppBundle\Form\PersonType">
            <tag name="form.type" alias="app_person_type" />
        </service>

    </services>

</container>
```

The final step is to update the ASFContactBundle Configuration for use your Product Form Type :

```yaml
# app/config/config.yml
asf_contact:
    person:
        form:
            type: AppBundle\Form\PersonType
```
