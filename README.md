vws-php
=======

The **VWS for PHP** enables PHP developers to use **VIA Web Services** in their PHP code, and build robust applications and software using services like VIA-Ebay, etc.

Installing
----------

The recommended way to install the VWS SDK for PHP is through Composer.

1.	Install Composer:

	```
	curl -sS https://getcomposer.org/installer | php
	```

2.	Next, run the Composer command to install the latest stable version of the VWS SDK for PHP:

	```
	composer require ossistyle/vws-php
	```

3.	After installing, you need to require Composer's autoloader in your app:

	```
	require 'vendor/autoload.php';
	```

Quick Examples
--------------

### Create an Via WebApi client

```php
<?php
// Require the Composer autoloader.
require 'vendor/autoload.php';

use Vws\Sdk;

$sdk = new Sdk([
    'version' => 'latest',
    'region'  => 'sandbox'
    'credentials' => [
        'username' => 'foo',
        'password' => 'bar',
        'subscription_token' => 'foo_bar'
    ]);

// Instantiate an Via WebApi Client.
$client = $sdk->createClient('webapi');

```

### Post single catalog with(out) child catalogs

```php
<?php
// create a single catalog with some child catalogs

$result = $client->postCatalog(
    [
        'Name' => 'Root Catalog',
        'IsRootLevel' => true,
        'ForeignId' => 'root_1',
        'ChildCatalogs' => [
            [
                'Name' => 'Child Catalog 1.1',
                'ForeignId' => 'child_1_1',
            ],
            [
                'Name' => 'Child Cata1og 1.2',
                'ForeignId' => 'child_1_2',
                'ChildCatalogs' => [
                    [
                        'Name' => 'Child Catalog 1.2.1',
                        'ForeignId' => 'child_1_2_1',
                    ],
                    [
                        'Name' => 'Child Cata1og 1.2.2',
                        'ForeignId' => 'child_1_2_2',
                    ]
                ]
            ]
        ]
    ]
);

var_export($result->toArray());

```
