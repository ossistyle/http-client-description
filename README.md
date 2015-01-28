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
$blacckbox = BlackboxClient::factory([
    'version' => 'latest',
    'region'  => 'sandbox'
]);
```
