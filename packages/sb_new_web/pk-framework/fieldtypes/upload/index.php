<?php

return [
	'id' => 'upload',
	'label' => __('File upload'),
	'class' => '\SB\PkFramework\FieldType\Upload\UploadFieldType',
	'autoload' => ['SB\\PkFramework\\FieldType\\Upload\\' => 'src'],
	'config' => [
		'hasOptions' => 0,
		'required' => 0,
		'multiple' => 1,
		'path' => 'uploads',
		'allowed' => ['png', 'jpg', 'jpeg', 'gif', 'svg'],
		'max_size' => 4,
		'max_files' => 0
	],
	'dependancies' => ['uikit-upload', 'uikit-form-file'],
	'styles' => [
		'uikit-upload' => 'app/assets/uikit/css/components/upload.css',
		'uikit-form-file' => 'app/assets/uikit/css/components/form-file.css',
		'uikit-placeholder' => 'app/assets/uikit/css/components/placeholder.css'
	]
];
