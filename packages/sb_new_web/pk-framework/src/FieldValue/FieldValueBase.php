<?php

namespace SB\PkFramework\FieldValue;

use SBWebApplication\Application as App;
use SB\PkFramework\Field\FieldBase;
use SBWebApplication\System\Model\DataModelTrait;

abstract class FieldValueBase implements FieldValueInterface {

	use DataModelTrait;

	/**
	 * @var array simple_array
	 */
	public $value = [];

	/**
	 * @var array
	 */
	protected $valuedata;

	/**
	 * @var FieldBase
	 */
	public $field;

	/**
	 * @var \SB\PkFramework\FieldType\FieldTypeBase
	 */
	protected $fieldType;

	/**
	 * Fieldsubmission constructor.
	 * @param FieldBase $field
	 * @return FieldValueBase
	 */
	public function setField (FieldBase $field) {
		$this->field = $field;
		$this->fieldType = App::module('sb/pk-framework')->getFieldType($field->type);
		return $this;
	}

	/**
	 * @return \SB\PkFramework\FieldType\FieldTypeBase
	 */
	public function getFieldType () {
		if (!isset($this->fieldType)) {
			$this->fieldType = App::module('sb/pk-framework')->getFieldType($this->field->type);
		}
		return $this->fieldType;
	}

	/**
	 * @param bool $asArray
	 * @return array|mixed
	 */
	public function getValue ($asArray = true) {
		if ($asArray) {
			return $this->value ?: [];
		}
		return $this->field->get('multiple') ? ($this->value ?: []) : (reset($this->value) ? : '');
	}

	/**
	 * @return bool
	 */
	public function hasValue () {
		return !empty($this->value);
	}

	/**
	 * @param mixed $value
	 * @param array $valuedata
	 * @return FieldValueBase
	 */
	public function setValue ($value, $valuedata = []) {
		$this->value = is_array($value) ? $value : (!empty($value) ? [$value] : []);
		$this->setValuedata($valuedata);
		return $this;
	}

	/**
	 * @param array $valuedata
	 */
	protected function setValuedata ($valuedata) {
		$this->getValuedata();
		foreach ($this->value as $i => $val) {
			$valueKey = 'data' . $i;
			if (isset($valuedata[$valueKey])) {
				$this->valuedata[$valueKey] = array_merge(['value' => $val], $valuedata[$valueKey]);
			}
		}
	}

	/**
	 * @param null $value
	 * @return array
	 */
	public function getValuedata ($value = null) {
		if (!isset($this->valuedata)) {
			$this->valuedata = [];
			foreach ($this->value as $i => $val) {
				$valueKey = 'data' . $i;
				$this->valuedata[$valueKey] = array_merge(['value' => $val], $this->get($valueKey, []));
			}
		}
		if ($value) {
			foreach ($this->valuedata as $data) {
				if ($data['value'] == $value) {
					return $data;
				}
			}
			return ['value' => $value];
		}
		return $this->valuedata;
	}

	/**
	 * @param array $data
	 * @param array $ignore
	 * @return array data for javascript exports
	 */
	public function toFormattedArray (array $data = [], array $ignore = []) {
		return array_merge(array_diff_key([
			'field' => $this->field->toArray([], ['fieldValue', 'fieldType']),
			'slug' => $this->field->slug,
			'type' => $this->getFieldType()->toArray(),
			'label' => $this->field->label,
			'value' => $this->getValue(),
			'formatted' => $this->formatValue(),
			'data' => $this->getValuedata()
		], array_flip($ignore)), $data);
	}

	/**
	 * @return array of formatted value(s)
	 */
	public function formatValue () {

		return $this->getFieldType()->formatValue($this->field, $this);

	}

}