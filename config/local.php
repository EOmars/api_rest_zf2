<?php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'user' => 'root',
                    'password' => 'secret',
                    'dbname' => 'escuela',
                    'charset' => 'utf8',
                    'driverOptions' => array(1002 => 'SET NAMES utf8'),
                ]
            ]
        ],
        'driver' => [
            'application_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../module/Application/src/Application/Entity')
            ],
            'orm_default' => [
                'drivers' => [
                    'Application\Entity' => 'application_entities'
                ]
            ]
        ]
    ]
];
