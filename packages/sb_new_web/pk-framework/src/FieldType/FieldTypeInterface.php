<?php

namespace SB\PkFramework\FieldType;

use SB\PkFramework\Field\FieldBase;
use SB\PkFramework\FieldValue\FieldValueBase;

interface FieldTypeInterface  {

	/**
	 * @return string
	 */
	public function getLabel ();

	/**
	 * @return array
	 */
	public function getExtensions ();

	/**
	 * @param FieldBase $field
	 * @return array
	 */
	public function getOptions (FieldBase $field);

	/**
	 * @param FieldBase $field
	 * @param FieldValueBase $fieldValue
	 * @return array
	 */
	public function prepareValue (FieldBase $field, FieldValueBase $fieldValue);

	/**
	 * @param FieldBase $field
	 * @param FieldValueBase $fieldValue
	 * @return array
	 */
	public function formatValue (FieldBase $field, FieldValueBase $fieldValue);

	/**
	 * @param \SBWebApplication\View\Asset\AssetManager $scripts
	 */
	public function registerScripts ($scripts);

	/**
	 * @param \SBWebApplication\View\Asset\AssetManager $styles
	 */
	public function addStyles ($styles);

	/**
	 * @return array
	 */
	public function toArray();
}