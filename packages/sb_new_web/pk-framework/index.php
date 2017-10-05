<?php
use SBWebApplication\Application as App;

return [

	'name' => 'sb/pk-framework',

	'type' => 'extension',

	'main' => 'SB\\PkFramework\\FrameworkModule',

	'fieldtypes' => 'fieldtypes',

	'autoload' => [
		'SB\\PkFramework\\' => 'src'
	],

    'routes' => [

        '/api/SB' => [
            'name' => '@SB/api',
            'controller' => [
                'SB\\PkFramework\\Controller\\FrameworkApiController',
                'SB\\PkFramework\\Controller\\ImageApiController',
            ]
        ]

    ],

    'resources' => [

		'sb/pk-framework:' => ''

	],

	'permissions' => [

		'SB: upload files' => [
			'title' => 'Upload files'
		]

	],

	'settings' => 'settings-SB',

	'config' => [
        'image_cache_path' => trim(str_replace(App::path(), '', App::get('path.storage') . '/SB'), '/'),
        'google_maps_key' => '',
	],

	'events' => [
		'view.scripts' => function ($event, $scripts) use ($app) {
            $version = $app->module('sb/pk-framework')->getVersionKey();
			$scripts->register('framework-settings', 'sb/pk-framework:app/bundle/settings.js',
                '~extensions', ['version' => $version]);
			$scripts->register('sb-pkframework', 'sb/pk-framework:app/bundle/sb-framework.js',
                ['vue'], ['version' => $version]);
			//register fields
            $dependancies = ['sb-pkframework', 'uikit-tooltip'];
            foreach ($app->module('sb/pk-framework')->getFieldTypes() as $fieldType) {
                //pick up dependancies from types
                if ($depends = $fieldType->registerScripts($scripts)) {
                    $dependancies = array_merge($dependancies, $depends);
                }
            }
			$scripts->register('sb-fieldtypes', 'sb/pk-framework:app/bundle/sb-fieldtypes.js',
                $dependancies, ['version' => $version]);
		},

        'view.data' => function ($event, $data) use ($app) {
            //todo can this be done only when framework js is loaded?
            $data->add('$pkframework', [
                'google_maps_key' => $app->module('sb/pk-framework')->config('google_maps_key')
            ]);
        },

		'console.init' => function ($event, $console) {

			$console->add(new SB\PkFramework\Console\Commands\TranslateCommand());

		},
	]

];
