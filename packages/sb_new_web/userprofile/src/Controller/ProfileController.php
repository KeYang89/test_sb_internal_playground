<?php

namespace SB\Userprofile\Controller;

use SBWebApplication\Application as App;

class ProfileController {

	/**
	 * main profile edit page
	 * @Route("/", methods="GET")
	 */
	public function indexAction () {
		$user = App::user();
		$userprofile = App::module('sb/userprofile');

		if (!$user->isAuthenticated()) {
			return App::redirect('@user/login', ['redirect' => App::url()->current()]);
		}

		return [
			'$view' => [
				'title' => __('Your Profile'),
				'name' => 'sb/userprofile/profile-edit.php'
			],
			'$data' => [
				'config' => $userprofile->config(),
				'user' => [
					'id' => $user->id,
					'username' => $user->username,
					'name' => $user->name,
					'email' => $user->email
				]
			]
		];

	}

	/**
	 * registration override page
	 * @Route("/registration")
	 */
	public function registrationAction () {

		$user = App::user();
		$userprofile = App::module('sb/userprofile');

		if ($user->isAuthenticated()) {
			return App::redirect('@userprofile');
		}

		return [
			'$view' => [
				'title' => __('User registration'),
				'name' => 'sb/userprofile/registration.php'
			],
			'$data' => [
				'config' => $userprofile->config(),
				'user' => [
					'id' => null,
					'username' => '',
					'name' => '',
					'email' => ''
				]
			]
		];

	}
}
