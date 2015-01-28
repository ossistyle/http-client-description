vws-php
===========

vws-php using GuzzleHttp Client

## Quick Examples

### Create an Via Blackbox client

```php
<?php
// Require the Composer autoloader.
require 'vendor/autoload.php';

use Vws\Blackbox\BlackboxClient;
use Vws\Exception\BlackboxException;

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

} catch (Vws\Blackbox\Exception\BlackboxException $e)
{
    echo '<pre>' . $e->getMessage() . '</pre>';
    echo '<h2>Request</h2>';
    echo '<pre>' . $e->getRequest() . '</pre>';
    echo '<h2>Response</h2>';
    echo '<pre>' . $e->getResponse() . '</pre>';
}
```

### Post a list of catalogs with(out) child catalogs

```php
<?php
// create a single catalog with some child catalogs
try {
    $result = $blackbox->postCatalogs([
        [
            'Name' => 'Root Catalog 1',
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
        ],
        [
            'Name' => 'Root Catalog 2',
            'IsRootLevel' => true,
            'ForeignId' => 'root_2',
            'ChildCatalogs' => [
                [
                    'Name' => 'Child Catalog 2.1',
                    'ForeignId' => 'child_2_1',
                ],
                [
                    'Name' => 'Child Cata1og 2.2',
                    'ForeignId' => 'child_2_2'
                ]
            ]
        ],
    ]);

    var_export($result->toArray());

} catch (Vws\Blackbox\Exception\BlackboxException $e)
{
    echo '<pre>' . $e->getMessage() . '</pre>';
    echo '<h2>Request</h2>';
    echo '<pre>' . $e->getRequest() . '</pre>';
    echo '<h2>Response</h2>';
    echo '<pre>' . $e->getResponse() . '</pre>';
}
```