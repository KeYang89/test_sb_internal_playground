<?php

use SBWebApplication\Markdown\Markdown;

return [

    'name' => 'markdown',

    'main' => function ($app) {

        $app['markdown'] = function() {
            return new Markdown;
        };

    },

    'autoload' => [

        'SBWebApplication\\Markdown\\' => 'src'

    ]

];
