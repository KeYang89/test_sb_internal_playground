<?php


namespace SB\PkFramework\FieldType;

use SB\PkFramework\Field\FieldBase;
use SB\PkFramework\FieldValue\FieldValueBase;
use SBWebApplication\Util\Arr;

abstract class FieldTypeBase implements FieldTypeInterface, \ArrayAccess, \JsonSerializable {
	/**
	 * @var string
	 */
	public $id;

	/**
	 * @var array
	 */
	protected $config;

	/**
	 * @var array
	 */
	protected $type;

	/**
	 * Type constructor.
	 * @param $type
	 */
	public function __construct ($type) {
		$this->id = $type['id'];
		$this->config = $type['config'];
		unset($type['config']);
		$this->type = $type;
		if (is_callable($this->type['main'])) {
			call_user_func($this->type['main']);
		}
	}

    /**
     * Call a method from the methods property
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call ($name, $arguments) {
        if (isset($this->type['methods'][$name]) && is_callable($this->type['methods'][$name])) {
            return call_user_func_array($this->type['methods'][$name], $arguments);
        }
        throw new \BadMethodCallException(sprintf('Method %s does not exist on %s.', $name, get_class($this)));
    }


    /**
     * @param \SBWebApplication\View\Asset\AssetManager $scripts
     * @return mixed
     */
	public function registerScripts ($scripts) {
        if ($this->type['loadScript']) {
            $script = $this->type['resource'] . '/fieldtype-' . $this->id . '.js';
            $scripts->register('fieldtype-' . $this->id, $script,
                array_merge(['~sb-fieldtypes'], $this->type['dependancies']));
            return [];
        } else {
            return $this->type['dependancies'];
        }
	}

	/**
	 * @param \SBWebApplication\View\Asset\AssetManager $styles
	 */
	public function addStyles ($styles) {
		foreach ($this->type['styles'] as $name => $source) {
			$styles->add($name, $source);
		}
	}

	/**
	 * @return string
	 */
	public function getLabel () {
		return (isset($this->type['label']) ? $this->type['label'] : $this->id);
	}

	/**
	 * @return array
	 */
	public function getExtensions () {
		return $this->type['extensions'];
	}

	/**
	 * @param FieldBase $field
	 * @return array
	 */
	public function getOptions (FieldBase $field) {
		if (is_callable($this->type['getOptions'])) {

			return call_user_func($this->type['getOptions'], $field);

		}
		return $field->options ?: [];
	}

	/**
	 * Prepare default value before displaying form
	 * @param FieldBase $field
	 * @param FieldValueBase $fieldValue
	 * @return array
	 */
	public function prepareValue (FieldBase $field, FieldValueBase $fieldValue) {
		if (is_callable($this->type['prepareValue'])) {

			return call_user_func($this->type['prepareValue'], $field, $fieldValue);

		}
		return $fieldValue->getValue();
	}

	/**
	 * @param FieldBase $field
	 * @param FieldValueBase $fieldValue
	 * @return array
	 */
	public function formatValue (FieldBase $field, FieldValueBase $fieldValue) {
		if (is_callable($this->type['formatValue'])) {
			return call_user_func($this->type['formatValue'], $field, $fieldValue);
		}
		$value = $fieldValue->getValue();
		if (count($field->getOptions())) {
			//return from selectoptions
			$options = $field->getOptionsRef();
			if (count($value)) {
				return array_map(function ($val) use ($options) {
					return isset($options[$val]) ? $options[$val] : $val;
				}, $value);
			}
			return ['-'];

		} else {
			//check for empty and return array
			return count($value) ? $value : ['-'];
		}
	}

	/**
	 * @return mixed
	 */
	public function getConfig () {
		return $this->config ?: [];
	}

	/**
	 * Checks if a key exists.
	 * @param  string $key
	 * @return bool
	 */
	public function offsetExists ($key) {
		return Arr::has($this->getConfig(), $key);
	}

	/**
	 * Gets a value by key.
	 * @param  string $key
	 * @return mixed
	 */
	public function offsetGet ($key) {
		return Arr::get($this->getConfig(), $key);
	}

	/**
	 * Sets a value.
	 * @param string $key
	 * @param string $value
	 */
	public function offsetSet ($key, $value) {
		$config = $this->getConfig();
		Arr::set($config, $key, $value);
	}

	/**
	 * Unset a value.
	 * @param string $key
	 */
	public function offsetUnset ($key) {
		$config = $this->getConfig();
		Arr::remove($config, $key);
	}

	/**
	 * @return array
	 */
	public function toArray () {
		return array_merge([
			'id' => $this->id,
			'label' => $this->getLabel()
		], $this->getConfig());
	}

	/**
	 * Specify data which should be serialized to JSON
	 * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	function jsonSerialize () {
		return $this->toArray();
	}
}