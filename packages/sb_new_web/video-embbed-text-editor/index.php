<?php

use Symfony\Component\HttpFoundation\Response;

return [

    'name' => 'tinymce',

    'events' => [

        'view.scripts' => function ($event, $scripts) use ($app) {
            $scripts->register('tinymce-script', 'tinymce:app/bundle/tinymce.js', ['~editor']);
            $scripts->register('tinymce-data', sprintf('var $tinymce = %s;', json_encode([
                    'root_url' => $app['url']->getStatic(__DIR__),
                    'skin_url' => $app['url']->getStatic(__DIR__ . '/app/assets/skin'),
                    'language_url' => $app['url']('@tinymce/intl', ['locale' => $app->module('system/intl')->getLocale()]),
                    'content_css' => $app['url']->getStatic($app['theme']->path . '/css/theme.css')
                ])
            ), ['~tinymce-script'], 'string');
        },

    ],

    'routes' => [

        'tinymce/{locale}.js' => [

            'name' => '@tinymce/intl',
            'controller' => function ($locale) use ($app) {

                $langFile = '';
                foreach (glob(__DIR__ . '/languages/*.js') as $file) {
                    $candidate = substr(basename($file), 0, -3);

                    if ($candidate === $locale) {
                        $langFile = $file;
                        break;
                    }

                    if (strpos($locale, $candidate) === 0 || strpos($candidate, $locale) === 0) {
                        $langFile = $file;
                    }

                }

                return new Response($langFile ? file_get_contents($langFile) : '', 200, ['Content-Type' => 'application/javascript']);

            }

        ]

    ]

];
