<?php

return [

    'name' => 'system/intl',

    'main' => 'SBWebApplication\\Intl\\IntlModule',

    'autoload' => [

        'SBWebApplication\\Intl\\' => 'src'

    ],

    'resources' => [

        'system/intl:' => ''

    ],

    'routes' => [
        '/system/intl' => [
            'name' => '@system/intl',
            'controller' => 'SBWebApplication\\Intl\\Controller\\IntlController'
        ],
    ],

    'config' => [

        'locale' => 'en_US'

    ],

    'events' => [

        'view.init' => function ($event, $view) {
            $view->addGlobal('intl', $this);
        }

    ]

];
