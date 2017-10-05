<?php

namespace SB\Userprofile\Model;

use SBWebApplication\Database\ORM\ModelTrait;
use SBWebApplication\User\Model\User;

trait ProfilevalueModelTrait {
	use ModelTrait;

	/**
	 * @param \SBWebApplication\User\Model\User $user
	 * @return array
	 */
	public static function getUserProfilevalues (User $user) {
		$query = self::where(['user_id' => $user->id]);
		$profileValues = [];
		foreach ($query->get() as $profileValue) {
			$profileValues[$profileValue->field_id] = $profileValue;
		}
		return $profileValues;
	}

}
