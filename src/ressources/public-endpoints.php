<?php
return [
    'version' => 2,
    'endpoints' => [
        '*/*' => [
            'endpoint' => '{region}.via.de'
        ],
        'local/blackbox' => [
            'endpoint' => 'local.via.de/WebApi/'
        ],
        'sandbox/blackbox' => [
            'endpoint' => 'sandboxapi.via.de:8001'
        ],
        'production/blackbox' => [
            'endpoint' => 'ebay.api.via.de'
        ],
    ]
];
