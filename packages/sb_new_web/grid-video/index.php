<?php

use SBWebApplication\Application as App;
use SBVideo\Video\Event\RouteListener;
use SBVideo\Video\VideoImageHelper;

return [

	'name' => 'sbvideo/video',

	'type' => 'extension',

	'main' => 'SBVideo\\Video\\VideoModule',

	'autoload' => [

		'SBVideo\\Video\\' => 'src'

	],

	'nodes' => [

		'video' => [
			'name' => '@video',
			'label' => 'Video',
			'controller' => 'SBVideo\\Video\\Controller\\SiteController',
			'protected' => true,
			'frontpage' => true
		]

	],

	'routes' => [

		'/video' => [
			'name' => '@video',
			'controller' => [
				'SBVideo\\Video\\Controller\\VideoController'
			]
		],
		'/api/video' => [
			'name' => '@video/api',
			'controller' => [
				'SBVideo\\Video\\Controller\\ProjectApiController',
				'SBVideo\\Video\\Controller\\ImageApiController'
			]
		]

	],

	'resources' => [

		'sbvideo/video:' => ''

	],

    'widgets' => [
        'widgets/video-projects.php'
    ],

    'menu' => [

		'video' => [
			'label' => 'Video',
			'icon' => 'sbvideo/video:icon.svg',
			'url' => '@video/project',
			'access' => 'video: manage video',
			'active' => '@video/project*'
		],

		'video: project' => [
			'label' => 'Projects',
			'parent' => 'video',
			'url' => '@video/project',
			'access' => 'video: manage video',
			'active' => '@video/project*'
		],

		'video: settings' => [
			'label' => 'Settings',
			'parent' => 'video',
			'url' => '@video/settings',
			'access' => 'video: manage settings',
			'active' => '@video/settings*'
		]

	],

	'permissions' => [

		'video: manage video' => [
			'title' => 'Manage video'
		],

		'video: manage settings' => [
			'title' => 'Manage settings'
		]

	],

	'settings' => '@video/settings',

	'config' => [
		'video_title' => 'My video',
		'video_text' => '<p>This is an overview of my latest projects.</p>',
		'video_image' => '',
		'projects_per_page' => 20,
        'project_ordering' => 'date|DESC',
		'video_image_align' => 'left',
		'columns' => 1,
		'columns_small' => 2,
		'columns_medium' => '',
		'columns_large' => 4,
		'columns_xlarge' => 6,
		'columns_gutter' => 20,
		'filter_tags' => true,
		'teaser' => [
			'show_title' => true,
			'show_subtitle' => true,
			'show_intro' => true,
			'show_image' => true,
			'show_client' => true,
			'show_tags' => true,
			'show_date' => true,
			'show_data' => true,
			'show_readmore' => true,
			'show_thumbs' => true,
			'template' => 'panel',
			'panel_style' => 'uk-panel-box',
			'overlay' => 'uk-overlay uk-overlay-hover',
			'overlay_position' => '',
			'overlay_effect' => 'uk-overlay-fade',
			'overlay_image_effect' => 'uk-overlay-scale',
			'content_align' => 'left',
			'tags_align' => 'uk-flex-center',
			'title_size' => 'uk-h3',
			'title_color' => '',
			'read_more' => 'Read more',
			'link_image' => 'uk-button',
			'read_more_style' => 'uk-button',
			'readmore_align' => 'uk-text-center',
			'thumbsize' => ['width' => 400, 'height' => ''],
			'columns' => 1,
			'columns_small' => 2,
			'columns_medium' => '',
			'columns_large' => 4,
			'columns_xlarge' => 6,
			'columns_gutter' => 20
		],
		'project' => [
			'image_align' => 'left',
			'metadata_position' => 'content-top',
			'tags_align' => 'uk-flex-center',
			'tags_position' => 'sidebar',
			'show_navigation' => 'bottom',
			'thumbsize' => ['width' => 400, 'height' => ''],
			'overlay_title_size' => 'uk-h3',
			'overlay' => 'uk-overlay uk-overlay-hover',
			'overlay_position' => '',
			'overlay_effect' => 'uk-overlay-fade',
			'overlay_image_effect' => 'uk-overlay-scale',
			'columns' => 1,
			'columns_small' => 2,
			'columns_medium' => '',
			'columns_large' => 4,
			'columns_xlarge' => 6,
			'columns_gutter' => 20
		],
		'cache_path' => str_replace(App::path(), '', App::get('path.cache') . '/video'),
		'date_format' => 'F Y',
		'markdown' => true,
		'datafields' => []
		],

	'events' => [

		'boot' => function ($event, $app) {
			$app->subscribe(
				new RouteListener
			);
			$app->extend('view', function ($view) use ($app) {
				return $view->addHelper(new VideoImageHelper($app));
			});
			//todo event to clear cache?
		},

		'view.scripts' => function ($event, $scripts) use ($app) {

			$scripts->register('uikit-grid', 'app/assets/uikit/js/components/grid.min.js', 'uikit');
			$scripts->register('uikit-lightbox', 'app/assets/uikit/js/components/lightbox.min.js', 'uikit');
		},

        'console.init' => function ($event, $console) {

			$console->add(new SBVideo\Video\Console\Commands\TranslateCommand());

		}
	]

];
