<?php

namespace SB\Userprofile\Controller;

use SB\Userprofile\Model\Field;
use SBWebApplication\Application as App;

/**
 * @Access(admin=true)
 */
class UserprofileController {

	public function indexAction () {
		$userprofile = App::module('sb/userprofile');

		return [
			'$view' => [
				'title' => __('Userprofile'),
				'name' => 'sb/userprofile/admin/fields.php'
			],
			'$data' => [
				'config' => App::module('sb/userprofile')->config('default'),
				'types' => $userprofile->getFieldTypes()
			],
            'frameworkValid' => $userprofile->checkFramework()
		];
	}

	/**
	 * @Access("system: access settings")
	 */
	public function settingsAction () {
		return [
			'$view' => [
				'title' => __('Userprofile settings'),
				'name' => 'sb/userprofile/admin/settings.php'
			],
			'$data' => [
			    'fields' => array_values(Field::findAll()),
				'config' => App::module('sb/userprofile')->config()
			]
		];
	}

	/**
	 * @Access("system: access settings")
	 * @Request({"config": "array"}, csrf=true)
	 */
	public function configAction($config = [])
	{
		App::config('sb/userprofile')->merge($config, true);
        App::config('sb/userprofile')->merge($config, true)
            ->set('list', $config['list'])
            ->set('details', $config['details']);

		return ['message' => 'success'];
	}

}
