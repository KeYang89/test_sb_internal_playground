<?php

namespace SB\Formmaker\Controller;

use SBWebApplication\Application as App;
use SBWebApplication\Kernel\Exception\NotFoundException;
use SB\Formmaker\Model\Form;

/**
 * @Access("formmaker: manage forms", admin=true)
 * @Route("form", name="form")
 */
class FormController {

	/**
	 * @Route("/edit", name="edit")
	 * @Request({"id": "int"})
	 */
	public function editAction ($id = 0) {
		$formmaker = App::module('sb/formmaker');

		if (!$form = Form::find($id)) {

			$form = Form::create();

		}

		if (!$form) {
			throw new NotFoundException(__('Form not found.'));
		}

		return [
			'$view' => [
				'title' => __('Form'),
				'name' => 'sb/formmaker/admin/edit.php'
			],
			'$data' => [
				'config' => $formmaker->config(),
				'types' => $formmaker->getFieldTypes(),
				'formitem' => $form
			]
		];
	}

}
