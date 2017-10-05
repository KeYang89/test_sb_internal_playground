<?php

use SBWebApplication\Filter\FilterManager;

return [

    'name' => 'filter',

    'main' => function ($app) {

        $app['filter'] = function() {
            return new FilterManager($this->config['defaults']);
        };

    },

    'autoload' => [

        'SBWebApplication\\Filter\\' => 'src'

    ],

    'config' => [

        'defaults' => null

    ]
];
