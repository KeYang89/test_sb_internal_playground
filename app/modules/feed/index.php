<?php

use SBWebApplication\Feed\FeedFactory;

return [

    'name' => 'feed',

    'main' => function ($app) {

        $app['feed'] = function () {
            return new FeedFactory;
        };

    },

    'autoload' => [

        'SBWebApplication\\Feed\\' => 'src'

    ]

];
