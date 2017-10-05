<?php
use SBWebApplication\Application as App;

return [
	'id' => 'sitelink',
	'label' => __('Website link'),
	'config' => [
		'hasOptions' => 0,
		'required' => -1,
		'multiple' => 1,
		'controls' => -1,
		'repeatable' => -1,
		'max_repeat' => 10,
		'blank_default' => 0,
		'link_text_default' => '',
		'href_class' => ''
	],
	'dependancies' => ['editor'],
	'formatValue' => function (\SB\PkFramework\Field\FieldBase $field, \SB\PkFramework\FieldValue\FieldValueBase $fieldValue) {
		return array_map(function ($site) use ($field) {
			if (empty($site['value'])) {
				return '-';
			}
			$blank = (!empty($site['blank']) ? 1 : $field->get('blank_default', 0)) ? ' target="_blank"' : '';
			$class = $field->get('href_class') ? ' class="' . $field->get('href_class') . '"' : '';
			$link_text = !empty($site['link_text']) ? $site['link_text'] : $field->get('link_text_default', $site['value']);

			return sprintf('<a href="%s"%s%s>%s</a>', $site['value'], $class, $blank, $link_text);
		}, $fieldValue->getValuedata());
	}
];
