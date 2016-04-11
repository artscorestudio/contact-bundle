# How to use ASFContactBundle CRUD System

> For more informations about ASFContactBundle entities, see [ASFContactBundle entities][1] section of this documentation.

ASFContactBundle provides four principal views for :
* List all contacts
* Create contacts
* Edit contacts
* remove contacts

For these features, ASFContactBundle provides set of routes, controllers and views based on the bundle's default data model allowing you to quickly manage the contacts throught a User Interface (UI). However, it's up to you to add these different views in your application : throught hardcored menus or via dynamic menus, etc.

Here is the route names :

| Route name | Parameters needed | Description |
| ---------- | ----------------- | ----------- |
| *asf_contact_identity_list* | none | For get the list of contacts. |
| *asf_contact_identity_add* | none | For access to the contact form and add new contact. |
| *asf_contact_identity_edit* | id: contact entity ID | For update an existing contact. |
| *asf_contact_identity_delete* | id: contact entity ID | For remove an existing contact. |


[1]: entities.md