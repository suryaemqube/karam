<?php
return [
    'backend' => [
        'frontName' => 'admin_kce'
    ],
    'remote_storage' => [
        'driver' => 'file'
    ],
    'cache' => [
        'graphql' => [
            'id_salt' => 'TuB8yXjjGgKhwNu1cze30HQ7Evg1lSro'
        ],
        'frontend' => [
            'default' => [
                'id_prefix' => '567_'
            ],
            'page_cache' => [
                'id_prefix' => '567_'
            ]
        ],
        'allow_parallel_generation' => false
    ],
    'config' => [
        'async' => 0
    ],
    'queue' => [
        'consumers_wait_for_messages' => 1
    ],
    'crypt' => [
        'key' => 'base64XYvVDlVB6q9FT3J2xnaSfmiFtyVCiFiQEzin+DO8qoQ= a3b52fcd79c1cdf5f8078db4b20403a1'
    ],
    'db' => [
        'table_prefix' => '',
        'connection' => [
            'default' => [
                'host' => 'localhost',
                'dbname' => 'jkzbfmgdnv',
                'username' => 'jkzbfmgdnv',
                'password' => '5p3gbqtRnM',
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'driver_options' => [
                    1014 => false
                ]
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'developer',
    'session' => [
        'save' => 'files'
    ],
    'lock' => [
        'provider' => 'db'
    ],
    'directories' => [
        'document_root_is_pub' => true
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'graphql_query_resolver_result' => 1,
        'full_page' => 1,
        'config_webservice' => 1,
        'translate' => 1
    ],
    'downloadable_domains' => [
        'phpstack-1270419-4588034.cloudwaysapps.com'
    ],
    'install' => [
        'date' => 'Tue, 28 May 2024 10:45:33 +0000'
    ]
];
