<?php
use SBWebApplication\Application as App;

return [
	'id' => 'htmlcode',
	'label' => __('Html code'),
	'config' => [
		'hasOptions' => 0,
		'required' => 0,
		'multiple' => 0,
		'markdown' => ''
	],
	'dependancies' => ['editor'],
	'formatValue' => function (\SB\PkFramework\Field\FieldBase $field, \SB\PkFramework\FieldValue\FieldValueBase $fieldValue) {
		return array_map(function ($val) use ($field) {
			return App::content()->applyPlugins($val, ['field' => $field, 'markdown' => $field->get('markdown')]);
		}, $fieldValue->getValue());
	}
];
