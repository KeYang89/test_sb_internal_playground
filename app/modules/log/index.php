<?php

use SBWebApplication\Log\Handler\DebugBarHandler;
use SBWebApplication\Log\Logger;

return [

    'name' => 'log',

    'main' => function ($app) {

        $app['log'] = function ($app) {

            $logger = new Logger($this->name);

            if (isset($app['debugbar'])) {
                $logger->pushHandler($app['log.debug']);
            }

            return $logger;
        };

        $app['log.debug'] = function () {
            return new DebugBarHandler();
        };

    },

    'autoload' => [

        'SBWebApplication\\Log\\' => 'src'

    ],

    'config' => [

        'name'  => 'log',
        'level' => 100

    ]

];
