<?php

namespace SB\PkFramework\FieldValue;


interface FieldValueInterface {

	/**
	 * @return \SB\PkFramework\FieldType\FieldTypeBase
	 */
	public function getFieldType ();

	/**
	 * @return array
	 */
	public function toFormattedArray ();

	/**
	 * @return array
	 */
	public function formatValue ();

}