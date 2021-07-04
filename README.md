# CustomJSBundle

A Kimai 2 plugin, which allows to edit custom JS code through an administration screen.

## Installation

First clone it to your Kimai installation `plugins` directory:
```bash
cd /kimai/var/plugins/
git clone https://github.com/kitzler-walli/CustomJSBundle
```

And then rebuild the cache: 
```bash
cd /kimai/
bin/console kimai:reload --env=prod
```

You could also [download it as zip](https://github.com/kitzler-walli/CustomJSBundle/archive/master.zip) and upload the directory via FTP:

```bash
/kimai/var/plugins/
├── CustomJSBundle
│   ├── CustomJSBundle.php
|   └ ... more files and directories follow here ... 
```

## Permissions

This bundle ships a new permission, which limit access to certain functionalities:

- `edit_custom_js` - every use that owns this permission 

By default, it is assigned to each user with the role `ROLE_SUPER_ADMIN`.

Read how to assign these permission to your user roles in the [permission documentation](https://www.kimai.org/documentation/permissions.html).

## Storage

This bundle stores the custom JS code in the file `var/data/custom-js-bundle.js`. 
Make sure its writable by your webserver and included in your backups.

## Screenshot

Screenshots are available [in the store page](https://www.kimai.org/store/keleo-js-custom-bundle.html).
