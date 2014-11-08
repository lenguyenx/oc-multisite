<?php
return [
'details' => [

'title' => 'Multisite',
'description' => 'Multisite support plugin for October',
'description2' => 'Manage multisite domain to theme binds',
'problem' => 'Multisite plugin tables not found, force reinstall plugin.',

],

'controller' => [
'settings' => 'Settings',
'confirm' => 'Are you sure?',
'new-bind' => 'New bind',
'delete' => 'Delete',
'clear-cache' => 'Clear cache',
'create-bind' => 'Create Bind',
'edit-bind' => 'Edit Bind',
'create' => 'Create',
'create-and-close' => 'Create and Close',
'cancel' => 'Cancel',
'return' => 'Return to settings list',
'creating' => 'Creating Setting...',
'or' => 'or',
'save' => 'Save',
'saving' => 'Saving ...',
'save-and-close' => 'Save and close',
'save-delete' => 'Delete save'
],

'domain' => [
'label' => 'Domain to bind theme to',
'comment' => 'Must be a full url, ie.: http://octobercms.com',
'theme-label' => 'Theme',
'theme-comment' => 'Select theme for this domain',
'protect-label' => 'Protect backend on this domain',
'protect-comment' => 'comment: Check if you want to prohibit backend entry from that domain, throws HTTP 401, uses /error page'
],

'flash' => [
'cache-clear' => 'Multisite cache cleared.',
'db-error' => 'Multisite plugin tables not found, force reinstall plugin.',
],

'tables' => [
'domain' => 'Domain',
'theme' => 'Theme',
'protected' => 'Protected?'

]
];