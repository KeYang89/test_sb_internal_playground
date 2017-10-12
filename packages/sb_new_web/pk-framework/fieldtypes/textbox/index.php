<?php
return [
	'id' => 'textbox',
	'label' => __('Text area'),
	'config' => [
		'hasOptions' => 0,
		'required' => -1,
		'multiple' => 0,
		'minLength' => 0,
		'maxLength' => 0,
		'rows' => 0,
		'placeholder' => 'type your answer'
	],
	'formatValue' => function (\SB\PkFramework\Field\FieldBase $field, \SB\PkFramework\FieldValue\FieldValueBase $fieldValue) {
		return array_map(function ($val) {
			return nl2br($val);
		}, $fieldValue->getValue());
	}
];