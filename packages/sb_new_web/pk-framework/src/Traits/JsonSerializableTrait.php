<?php

namespace SB\PkFramework\Traits;


use SBWebApplication\Util\Arr;

trait JsonSerializableTrait {

	/**
	 * JsonSerializable constructor.
	 * @param array  $data
	 */
	public function __construct (array $data = []) {
		foreach (get_object_vars($this) as $key => $default) {
			$this->$key = Arr::get($data, $key, $default);
		}
	}

	/**
	 * @param array $data
	 * @param array $ignore
	 * @return array
	 */
	public function toArray ($data = [], $ignore = []) {
		foreach (get_object_vars($this) as $key => $value) {
			$data[$key] = $value;
		}
		return array_diff_key($data, array_flip($ignore));
	}

	/**
	 * @return array
	 */
	function jsonSerialize () {
		return $this->toArray();
	}

}