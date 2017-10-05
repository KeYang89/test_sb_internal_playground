<?php

use SB\Userprofile\User\ProfileUser;

return [

	'name' => 'sb/userprofile',

	'type' => 'extension',

	'main' => 'SB\\Userprofile\\UserprofileModule',

	'autoload' => [

		'SB\\Userprofile\\' => 'src'

	],

    'nodes' => [

        'user_profiles' => [
            'name' => '@userprofile/profiles',
            'label' => 'Profiles list',
            'controller' => 'SB\\Userprofile\\Controller\\ProfilesController',
        ]

    ],

    'routes' => [

		'/profile' => [
			'name' => '@userprofile',
			'controller' => 'SB\\Userprofile\\Controller\\ProfileController'
		],
		'/profiles' => [
			'name' => '@userprofile/profiles',
			'controller' => 'SB\\Userprofile\\Controller\\ProfilesController'
		],
		'/userprofile' => [
			'name' => '@userprofile/admin',
			'controller' => [
				'SB\\Userprofile\\Controller\\UserprofileController',
				'SB\\Userprofile\\Controller\\FieldController'
			]
		],
		'/api/userprofile/field' => [
			'name' => '@site/api/field',
			'controller' => 'SB\\Userprofile\\Controller\\FieldApiController'
		],
		'/api/userprofile/profile' => [
			'name' => '@site/api/profile',
			'controller' => 'SB\\Userprofile\\Controller\\ProfileApiController'
		]

	],

	'fieldtypes' => 'fieldtypes',

	'resources' => [

		'sb/userprofile:' => ''

	],

	'menu' => [

		'userprofile' => [
			'label' => 'Userprofile',
			'icon' => 'packages/sb_new_web/userprofile/icon.svg',
			'url' => '@userprofile/admin',
			'active' => '@userprofile(/*)'
		],

		'userprofile: fields' => [
			'label' => 'Fields',
			'parent' => 'userprofile',
			'url' => '@userprofile/admin',
			'active' => '@userprofile/admin(/edit)?'
		],

		'userprofile: settings' => [
			'label' => 'Settings',
			'parent' => 'userprofile',
			'url' => '@userprofile/admin/settings',
			'active' => '@userprofile/admin/settings'
		]

	],

	'permissions' => [

		'userprofile: manage settings' => ['title' => 'Manage settings'],
		'userprofile: view profiles' => ['title' => 'View user profiles'],

	],

	'settings' => '@userprofile/settings',

	'config' => [

		'override_registration' => 1,
		'slug_key' => 'username',
		'avatar_field' => '',
		'use_gravatar' => true,
		'fallback_image_src' => '',
		'list' => [
			'profiles_per_page' => 16,
			'columns' => 4,
			'columns_small' => '',
			'columns_medium' => '',
			'columns_large' => '',
			'columns_xlarge' => '',
			'template' => 'vertical',
			'panel_style' => 'uk-panel-box',
			'show_title' => 'name',
            'show_username' => true,
            'show_name' => false,
            'show_email' => true,
            'show_image' => true,
            'show_fields' => [],
			'title_size' => 'uk-module-title',
			'title_color' => '',
			'link_profile' => 'panel',
        ],
		'details' => [
			'show_fields' => [],
			'show_email' => true,
			'show_image' => true,
			'show_username' => true
		]

	],

	'events' => [

		'request' => function ($event, $request) use ($app) {
			if ($app->config('sb/userprofile')->get('override_registration', true) && $request->attributes->get('_route') == '@user/registration') {
				$event->setResponse($app->redirect('@userprofile/registration'), [], 301);
			}
		},

        'view.system/site/admin/edit' => function ($event, $view) {
            $view->script('node-user_profiles', 'sb/userprofile:app/bundle/node-user_profiles.js', 'site-edit');
        },

		'view.scripts' => function ($event, $scripts) use ($app) {
			$scripts->register('link-userprofile', 'sb/userprofile:app/bundle/link-userprofile.js', '~panel-link');
			$scripts->register('user-section-userprofile', 'sb/userprofile:app/bundle/user-section-userprofile.js', ['~user-edit', 'sb-fieldtypes']);
		},

		'view.data' => function ($event, $data) use ($app) {
			$route = $app->request()->attributes->get('_route');
			if (strpos($route, '@userprofile') === 0 || $route == '@user/edit') {
				$data->add('$fieldtypes', [
					'ajax_url' => 'api/userprofile/profile/ajax'
				]);
			}
			//load profile
			if (in_array($route, ['@userprofile', '@userprofile/registration', '@user/edit'])) {
				$self = $app->user();
				$edit_id = $app->request()->get('id');
				if ($route == '@user/edit') { //blank user when admin creates new user
					$user = $edit_id ? \SBWebApplication\User\Model\User::find($edit_id) : \SBWebApplication\User\Model\User::create();
				} else {
					$user = $self;
				}
				if ($self->hasAccess('user: manage users') || $user->id == $self->id) {
                    $profileUser = ProfileUser::load($user);
                    $data->add('$userprofile', [
						'fields' => array_values(\ SB\Userprofile\Model\Field::getProfileFields()),
                        'profilevalues' => $app->module('sb/userprofile')->getProfile($user),
						'profile_user' => $profileUser,
					]);
				}
			}
		},

		'view.styles' => function ($event, $styles) use ($app) {
			$route = $app->request()->attributes->get('_route');
			if (strpos($route, '@userprofile') === 0 || in_array($route, ['@user/edit'])) {
				foreach ($app->module('sb/userprofile')->getFieldTypes() as $type) {
					$type->addStyles($styles);
				}
			}
		},

		'console.init' => function ($event, $console) {

			$console->add(new SB\Userprofile\Console\Commands\TranslateCommand());

		}

	]

];
