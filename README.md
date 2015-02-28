vws-php
===========

vws-php using GuzzleHttp Client

The **VWS for PHP** enables PHP developers to use [VIA Web Services][vws]
in their PHP code, and build robust applications and software using services
like VIA-Ebay, etc. You can get started in
minutes by [installing the SDK through Composer][docs-installation] or by
downloading a single zip or phar file from our [latest release][latest-release].

## Installing

The recommended way to install the AWS SDK for PHP is through Composer.

1. Install Composer:

        curl -sS https://getcomposer.org/installer | php

2. Next, run the Composer command to install the latest stable version of
   the AWS SDK for PHP:

        composer require ossistyle/vws-php

3. After installing, you need to require Composer's autoloader in your app:

        require 'vendor/autoload.php';


## Quick Examples

### Create an Via Blackbox client

```php
<?php
// Require the Composer autoloader.
require 'vendor/autoload.php';

use Vws\Blackbox\BlackboxClient;
use Vws\Blackbox\Exception\BlackboxException;

try {
    // Instantiate an Via Blackbox Client.
    $blackbox = BlackboxClient::factory([
        'version' => 'latest',
        'region'  => 'sandbox'
        'credentials' => [
            'username' => 'foo',
            'password' => 'bar',
            'subscription_token' => 'foo_bar'
        ]
    ]);
} catch (\Exception $e)
{
    echo '<pre>' . $e->getMessage() . '</pre>';
}
```


### Post single catalog with(out) child catalogs

```php
<?php
// create a single catalog with some child catalogs
try {
    $result = $blackbox->postCatalog(
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

} catch (BlackboxException $e)
{
    echo '<pre>' . $e->getMessage() . '</pre>';
    echo '<h2>Request</h2>';
    echo '<pre>' . $e->getRequest() . '</pre>';
    echo '<h2>Response</h2>';
    echo '<pre>' . $e->getResponse() . '</pre>';
}
```

