<?php

namespace SB\Userprofile\Controller;

use SBWebApplication\Application as App;
use SBWebApplication\Kernel\Exception\NotFoundException;
use SB\Userprofile\Model\Field;
use SBWebApplication\User\Model\Role;

/**
 * @Access("site: manage site")
 */
class FieldController {

	/**
	 * @Route("/edit")
	 * @Request({"id"})
	 * @Access("site: manage site", admin=true)
	 */
	public function editAction ($id = '') {
		/** @var \ SB\Userprofile\UserprofileModule $userprofile */
		$userprofile = App::module('sb/userprofile');

		if (is_numeric($id)) {
			$field = Field::find($id);
		} else {
			$field = Field::create();
			$field->setFieldType($id);
			$field->set('value', []);
			$field->set('data', []);
		}

		if (!$field) {
			throw new NotFoundException(__('Field not found.'));
		}

		if (!$type = $userprofile->getFieldType($field->type)) {
			throw new NotFoundException(__('Type not found.'));
		}
		$fixedFields = ['multiple', 'required', 'controls', 'repeatable'];
		if (!$field->id) {
			foreach ($type->getConfig() as $key => $value) {
				if (!in_array($key, $fixedFields)) $field->set($key, $value);
			}
		}
		//check fixed value
		foreach ($fixedFields as $key) {
			if (!isset($type[$key])) $type[$key] = 0;
			if ($type[$key] != -1) {
				$field->set($key, $type[$key]);
			}
		}

		return [
			'$view' => [
				'title' => __('Field'),
				'name' => 'sb/userprofile/admin/edit.php'
			],
			'$data' => [
				'field' => $field,
				'type' => $type,
				'roles' => array_values(Role::findAll())

			]
		];
	}

}
