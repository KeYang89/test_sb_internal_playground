<?php

namespace SB\Formmaker\Controller;

use SBWebApplication\Application as App;
use SB\Formmaker\Model\Form;
use SB\Formmaker\Model\Submission;

/**
 * @Access(admin=true)
 */
class FormmakerController {

	/**
	 * @Route("/", methods="GET")
	 */
	public function indexAction () {
        $formmaker = App::module('sb/formmaker');

		return [
			'$view' => [
				'title' => __('Formmaker'),
				'name' => 'sb/formmaker/admin/forms.php'
			],
			'$data' => [
				'config' => $formmaker->config()
			],
            'frameworkValid' => $formmaker->checkFramework()
		];
	}

	/**
	 * @Route("/submissions", methods="GET")
	 * @Request({"filter": "array", "page":"int"})
	 */
	public function submissionsAction ($filter = null, $page = 0) {
        $formmaker = App::module('sb/formmaker');

		return [
			'$view' => [
				'title' => __('Submissions'),
				'name' => 'sb/formmaker/admin/submissions.php'
			],
			'$data' => [
				'forms' => array_values(Form::query()->get()),
				'statuses' => Submission::getStatuses(),
				'config'   => [
					'filter' => $filter,
					'page'   => $page
				]
			],
            'frameworkValid' => $formmaker->checkFramework()
		];
	}

	/**
	 * @Route("/submissions/csv", methods="GET")
	 */
	public function csvAction () {
		//todo
		return [
			'$data' => [
			]
		];
	}

}
