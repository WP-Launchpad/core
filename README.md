## Use the core

To use the core as it is without the framework, it is also possible.

### Create a parameter file

At the root from the plugin create the following file `configs/parameters.php` with the follwing content:

```php
<?php

return [
    'plugin_name'        => sanitize_key( 'My plugin' ),
    'translation_key'      => 'myplugin',
    'is_mu_plugin'      => false,
    'prefix' => 'mu_plugin_',
];
```

### Create a service providers file

At the root from the plugin create the following file `configs/providers.php` with the follwing content:

```php
<?php

return [

];
```

### Include the library

Use the command `composer require wp-launchpad/core` to add it to the plugin.

### Load the core inside the main plugin file

Inside the main file from the plugin add the following content to load the core:

```php
/**
 * Plugin comment
 */
 
use function LaunchpadCore\boot;

require __DIR__ . '/inc/Dependencies/LaunchpadCore/boot.php';
 
boot( __FILE__ );
```