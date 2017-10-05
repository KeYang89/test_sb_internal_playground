<?php


namespace SB\PkFramework\Field;


interface FieldInterface {

	/**
	 * @param string $type
	 */
	public function setFieldType ($type);

	/**
	 * @return \SB\PkFramework\FieldType\FieldTypeBase
	 */
	public function getFieldType ();

	/**
	 * Set select-options
	 * @param array $options
	 */
	public function setOptions ($options);

	/**
	 * Get select-options
	 * @return array
	 */
	public function getOptions ();

	/**
	 * reference value=>label for easy formatting
	 * @return array
	 */
	public function getOptionsRef ();

	/**
	 * Prepare value before rendering
	 * @return array
	 */
	public function formatValue ();

	/**
	 * @param array $data
	 * @param array $ignore
	 * @return array
	 */
	public function toArray(array $data = [], array $ignore = []);

}