<?php

return [

    'name' => 'system/dashboard',

    'main' => 'SBWebApplication\\Dashboard\\DashboardModule',

    'autoload' => [

        'SBWebApplication\\Dashboard\\' => 'src'

    ],

    'routes' => [

        '/dashboard' => [
            'name' => '@dashboard',
            'controller' => 'SBWebApplication\\Dashboard\\Controller\\DashboardController'
        ]

    ],

    'resources' => [

        'system/dashboard:' => ''

    ],

    'menu' => [

        'dashboard' => [
            'label' => 'Dashboard',
            'icon' => 'system/dashboard:assets/images/icon-dashboard.svg',
            'url' => '@dashboard',
            'active' => '@dashboard*',
            'priority' => 100
        ]

    ],

    'config' => [

        'defaults' => []

    ]

];
