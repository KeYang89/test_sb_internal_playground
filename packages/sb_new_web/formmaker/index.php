<?php

return [

	'name' => 'sb/formmaker',

	'type' => 'extension',

	'main' => 'SB\\Formmaker\\FormmakerModule',

	'autoload' => [

		'SB\\Formmaker\\' => 'src'

	],

	'routes' => [

		'/formmaker' => [
			'name' => '@formmaker',
			'controller' => [
				'SB\\Formmaker\\Controller\\FormmakerController',
				'SB\\Formmaker\\Controller\\FormController',
				'SB\\Formmaker\\Controller\\SiteController'
			]
		],
		'/api/formmaker' => [
			'name' => '@formmaker/api',
			'controller' => [
				'SB\\Formmaker\\Controller\\FieldApiController',
				'SB\\Formmaker\\Controller\\FormApiController',
				'SB\\Formmaker\\Controller\\SubmissionApiController'
			]
		]

	],

	'widgets' => [

		'widgets/siteform.php'

	],

	'fieldtypes' => 'fieldtypes',

	'resources' => [

		'sb/formmaker:' => ''

	],

	'menu' => [

		'formmaker' => [
			'label' => 'Formmaker',
			'icon' => 'packages/sb_new_web/formmaker/icon.svg',
			'url' => '@formmaker',
			// 'access' => 'formmaker: manage hellos',
			'active' => '@formmaker(/*)'
		],

		'formmaker: forms' => [
			'label' => 'Forms',
			'parent' => 'formmaker',
			'url' => '@formmaker',
			'access' => 'formmaker: manage forms',
			'active' => '@formmaker(/edit)?'
		],

		'formmaker: submissions' => [
			'label' => 'Submissions',
			'parent' => 'formmaker',
			'url' => '@formmaker/submissions',
			'access' => 'formmaker: manage submissions',
			'active' => '@formmaker/submissions'
		]

	],

	'permissions' => [

		'formmaker: manage settings' => [
			'title' => 'Manage settings'
		],

		'formmaker: manage forms' => [
			'title' => 'Manage forms'
		],

		'formmaker: manage submissions' => [
			'title' => 'Manage submissions'
		]

	],

	'settings' => 'settings-formmaker',

	'config' => [
		'from_address' => '',
		'recaptha_sitekey' => '',
		'recaptha_secret_key' => '',
		'submissions_per_page' => 20

	],

	'events' => [

		'view.scripts' => function ($event, $scripts) use ($app) {
			if ($app['user']->hasAccess('formmaker: manage submissions')) {
				$scripts->register('widget-formmaker', 'sb/formmaker:app/bundle/widget-formmaker.js', ['~dashboard']);
			}
			$scripts->register('formmaker-settings', 'sb/formmaker:app/bundle/settings.js', '~extensions');
			$scripts->register('link-formmaker', 'sb/formmaker:app/bundle/link-formmaker.js', '~panel-link');
		},

		'view.data' => function ($event, $data) use ($app) {
			$route = $app->request()->attributes->get('_route');
			if (strpos($route, '@formmaker') === 0) {
				$data->add('$fieldtypes', [
					'ajax_url' => 'api/formmaker/submission/ajax'
				]);
			}
		},

		'view.styles' => function ($event, $styles) use ($app) {
			$route = $app->request()->attributes->get('_route');
			if (strpos($route, '@formmaker') === 0) {
				foreach ($app->module('sb/formmaker')->getFieldTypes() as $type) {
					$type->addStyles($styles);
				}
			}
		},

        'console.init' => function ($event, $console) {

			$console->add(new \SB\Formmaker\Console\Commands\TranslateCommand());

		}
	]

];
