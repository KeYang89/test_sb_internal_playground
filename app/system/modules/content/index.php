<?php

use SBWebApplication\Content\ContentHelper;
use SBWebApplication\Content\Plugin\MarkdownPlugin;
use SBWebApplication\Content\Plugin\SimplePlugin;
use SBWebApplication\Content\Plugin\VideoPlugin;

return [

    'name' => 'system/content',

    'main' => function ($app) {

        $app->subscribe(
            new MarkdownPlugin,
            new SimplePlugin,
            new VideoPlugin
        );

        $app['content'] = function() {
            return new ContentHelper;
        };

    },

    'autoload' => [

        'SBWebApplication\\Content\\' => 'src'

    ]

];
