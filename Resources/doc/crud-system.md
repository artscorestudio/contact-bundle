# How to use ASFContactBundle CRUD System

> For more informations about ASFContactBundle entities, see [ASFContactBundle entities][1] section of this documentation.

ASFContactBundle provides four principal views for :
* List all contacts
* Create contacts
* Edit contacts
* remove contacts

For these features, ASFContactBundle provides set of routes, controllers and views based on the bundle's default data model allowing you to quickly manage the contacts throught a User Interface (UI). However, it's up to you to add these different views in your application : throught hardcored menus or via dynamic menus, etc.

## Default routes provided for edit contacts

| Route name | Parameters needed | Description |
| ---------- | ----------------- | ----------- |
| *asf_contact_identity_list* | none | For get the list of contacts. |
| *asf_contact_identity_add* | none | For access to the contact form and add new contact. |
| *asf_contact_identity_edit* | id: contact entity ID | For update an existing contact. |
| *asf_contact_identity_delete* | id: contact entity ID | For remove an existing contact. |


## Flash Messages

Controllers generate messages for the success or errors during the process. This messages are stored in Session Flash Messages. Displaying flash messages might look as follows :

```twig
{% for type, messages in app.session.flashbag.all() %}
    {% for message in messages %}
        <div class="flash-{{ type }}">{{ message }}</div>
    {% endfor %}
{% endfor %}
``` 

For further informations about Session Flash Messages, see [Symfony documentation : Session Management][2]

## Forms

The forms provided by ASFContactBundle use generic [Symfony Form Types][3] or if installed more advanced form features like form templating or specific types like *CollectionType* or *DatePickerType*, etc. based on Twitter Bootstrap with [artscorestudio/layout-bundle][4].

[1]: entities.md
[2]: http://symfony.com/doc/current/components/http_foundation/sessions.html
[3]: http://symfony.com/doc/current/reference/forms/types.html
[4]: https://packagist.org/packages/artscorestudio/layout-bundle