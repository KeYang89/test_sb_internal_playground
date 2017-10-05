<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Logging\DebugStack;
use Doctrine\DBAL\Types\Type;
use SBWebApplication\Database\ORM\EntityManager;
use SBWebApplication\Database\ORM\Loader\AnnotationLoader;
use SBWebApplication\Database\ORM\MetadataManager;
use SBWebApplication\Event\PrefixEventDispatcher;

$config = [

    'name' => 'database',

    'main' => function ($app) {

        $default = [
            'wrapperClass' => 'SBWebApplication\Database\Connection'
        ];

        $app['dbs'] = function () use ($default) {

            $dbs = [];

            foreach ($this->config['connections'] as $name => $params) {
                $dbs[$name] = DriverManager::getConnection(array_replace($default, $params));
            }

            return $dbs;
        };

        $app['db'] = function ($app) {
            return $app['dbs'][$this->config['default']];
        };

        $app['db.em'] = function ($app) {
            return new EntityManager($app['db'], $app['db.metas'], $app['db.events']);
        };

        $app['db.metas'] = function ($app) {

            $manager = new MetadataManager($app['db'], $app['db.events']);
            $manager->setLoader(new AnnotationLoader);
            $manager->setCache($app['cache.phpfile']);

            return $manager;
        };

        $app['db.events'] = function ($app) {
            return new PrefixEventDispatcher('model.', $app['events']);
        };

        $app['db.debug_stack'] = function () {
            return new DebugStack();
        };

        Type::overrideType(Type::SIMPLE_ARRAY, '\SBWebApplication\Database\Types\SimpleArrayType');
        Type::overrideType(Type::JSON_ARRAY, '\SBWebApplication\Database\Types\JsonArrayType');
    },

    'autoload' => [

        'SBWebApplication\\Database\\' => 'src'

    ],

    'config' => [

        'default' => 'sqlite',

        'connections' => [

            'mysql' => [

                'driver'   => 'pdo_mysql',
                'dbname'   => '',
                'host'     => 'localhost',
                'user'     => 'root',
                'password' => '',
                'engine'   => 'InnoDB',
                'charset'  => 'utf8',
                'collate'  => 'utf8_unicode_ci',
                'prefix'   => ''

            ],

            'sqlite' => [

                'driver' => 'pdo_sqlite',
                'path' => "sb_new_web.db",
                'charset' => 'utf8',
                'prefix' => 'pk_',
                'driverOptions' => [
                    'userDefinedFunctions' => [
                        'REGEXP' => [
                            'callback' => function ($pattern, $subject) {
                                return preg_match("/$pattern/", $subject);
                            },
                            'numArgs' => 2
                        ]
                    ]
                ]

            ]

        ]

    ]

];

if (defined('PDO::MYSQL_ATTR_INIT_COMMAND')) {
    $config['config']['connections']['mysql']['driverOptions'] = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_unicode_ci'
    ];
}

return $config;