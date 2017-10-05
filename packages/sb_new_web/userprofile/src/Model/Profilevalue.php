<?php

namespace SB\Userprofile\Model;
use SB\PkFramework\FieldValue\FieldValueBase;
use SBWebApplication\System\Model\DataModelTrait;

/**
 * @Entity(tableClass="@userprofile_value")
 */
class Profilevalue extends FieldValueBase implements \JsonSerializable {

	use ProfilevalueModelTrait;

	/** @Column(type="integer") @Id */
	public $id = 0;

	/** @Column(type="integer") */
	public $user_id = 0;

	/** @Column(type="integer") */
	public $field_id = 0;

	/** @Column(type="integer") */
	public $multiple = 0;

	/** @Column(type="simple_array") */
	public $value = [];

	/**
	 * {@inheritdoc}
	 */
	public function jsonSerialize () {
		return $this->toArray();
	}

}
