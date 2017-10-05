<?php
return [
	'id' => 'agree',
	'label' => __('Agree checkbox'),
	'config' => [
		'hasOptions' => 0,
		'required' => -1,
		'multiple' => 0,
        'checkbox_label_pre' =>  'Please agree with our',
        'checkbox_label_link' =>  'terms and conditions',
        'checkbox_label_post' =>  '.',
        'text_page_id' => 0,
        'text_page' => [],
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