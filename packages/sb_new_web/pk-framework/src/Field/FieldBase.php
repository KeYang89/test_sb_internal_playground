<?php


namespace SB\PkFramework\Field;

use SB\PkFramework\FieldValue\FieldValue;
use SBWebApplication\Application as App;
use SB\PkFramework\FieldType\FieldTypeBase;
use SB\PkFramework\FieldValue\FieldValueBase;
use SBWebApplication\System\Model\DataModelTrait;

abstract class FieldBase implements FieldInterface {

	use DataModelTrait;

	/**
	 * @var string
	 */
	public $type;
	/**
	 * @var string
	 */
	public $slug;
	/**
	 * @var string
	 */
	public $label;
	/**
	 * @var array
	 */
	public $options = [];

	/**
	 * @var FieldTypeBase
	 */
	protected $fieldType;

	/**
	 * @var FieldValueBase
	 */
	protected $fieldValue;

	/**
	 * @param string $type
	 */
	public function setFieldType ($type) {
		$this->type = $type;
	}

	/**
	 * @return FieldTypeBase
	 */
	public function getFieldType () {
		if (!isset($this->fieldType)) {
			$this->fieldType = App::module('sb/pk-framework')->getFieldType($this->type);
		}
		return $this->fieldType;
	}

	/**
	 * default value for field
	 * @return FieldValueBase
	 */
	public function getFieldValue () {
		if (!isset($this->fieldValue)) {
			$this->fieldValue = new FieldValue($this, $this->get('value', []), $this->get('data', []));
		}
		return $this->fieldValue;
	}

	/**
	 * Set select-options
	 * @param array $options
	 */
	public function setOptions ($options) {
		$this->options = $options;
	}

	/**
	 * Get select-options
	 * @return array
	 */
	public function getOptions () {
		return $this->getFieldType()->getOptions($this);
	}

	/**
	 * reference value=>label for easy formatting
	 * @return array
	 */
	public function getOptionsRef () {
		$options = [];
		foreach ($this->getOptions() as $option) {
			$options[$option['value']] = $option['text'];
		}
		return $options;
	}

	/**
	 * get raw value
	 * @return array
	 */
	public function getValue () {
		return $this->getFieldValue()->getValue();
	}

	/**
	 * Prepare value before rendering
	 * @param null $value
	 * @return array
	 */
	public function getValuedata ($value = null) {
		return $this->getFieldValue()->getValuedata($value);
	}

	/**
	 * Prepare value before rendering
	 * @return array
	 */
	public function formatValue () {
		return $this->getFieldType()->formatValue($this, $this->getFieldValue());
	}

	/**
	 * Mostly overridden by ModelTrait toArray
	 * @param array $data
	 * @param array $ignore
	 * @return array
	 */
	public function toArray(array $data = [], array $ignore = []) {
		return array_merge(array_diff_key([
			'type' => $this->type,
			'label' => $this->label,
			'slug' => $this->slug,
			'options' => $this->getOptions(),
			'value' => $this->getFieldValue()->getValue(),
			'valuedata' => $this->getFieldValue()->getValuedata(),
			'formatted' => $this->formatValue(),
			'data' => $this->data
		], array_flip($ignore)), $data);
	}

}