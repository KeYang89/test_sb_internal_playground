<?php
return [
	'id' => 'map',
	'label' => __('Location'),
	'config' => [
		'hasOptions' => 0,
		'required' => -1,
		'multiple' => 0,
        'minHeight' => 500,
        'default_lat' => 20,
        'default_lng' => 0,
        'default_zoom' => 2,
	],
    'methods' => [
        'pageAction' => function ($data) {
            if ($page = \SBWebApplication\Site\Model\Page::find($data['id'])) {
                return $page;
            }
            return ['content' => 'Page not found'];
        },
    ],
];