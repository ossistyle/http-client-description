<?php
return [
    'version' => 2,
    'endpoints' => [
        '*/*' => [
            'endpoint' => '{region}.via.de',
        ],
        'local/blackbox' => [
            'endpoint' => 'local.via.de/WebApi/api/',
        ],
        'sandbox/blackbox' => [
            'endpoint' => 'sandboxapi.via.de:8001',
        ],
        'sandbox-new/blackbox' => [
            'endpoint' => 'dus-bb-api802.dus.via.de/api/',
        ],
        'sandbox-old/blackbox' => [
            'endpoint' => 'sandboxapi.via.de/publicapi/v1/api.svc/',
        ],
        'production/blackbox' => [
            'endpoint' => 'ebay.api.via.de',
        ],
    ],
];
