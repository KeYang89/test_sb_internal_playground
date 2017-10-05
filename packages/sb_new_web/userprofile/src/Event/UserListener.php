<?php

namespace SB\Userprofile\Event;

use SB\Userprofile\User\ProfileUser;
use SBWebApplication\Application as App;
use SBWebApplication\Event\EventSubscriberInterface;
use SBWebApplication\User\Model\User;
use SB\Userprofile\Model\Profilevalue;

class UserListener implements EventSubscriberInterface {

	protected $request;

	/**
	 * @param      $event
	 * @param User $user
	 */
	public function onUserChange ($event, User $user) {
		$profilevalues = App::request()->request->get('profilevalues', []);
		if (count($profilevalues)) {
			$profileUser = ProfileUser::load($user);
			$profileUser->setProfileValues($profilevalues);
			$profileUser->saveProfile();
            //only save once
            App::request()->request->set('profilevalues', []);
		}
	}

	/**
	 * @param      $event
	 * @param User $user
	 */
	public function onUserDeleted ($event, User $user) {
		foreach (Profilevalue::where(['user_id = :id'], [':id' => $user->id])->get() as $profilevalue) {
			$profilevalue->delete();
		}
	}


	/**
	 * {@inheritdoc}
	 */
	public function subscribe () {
		return [
			'model.user.created' => 'onUserChange',
			'model.user.saved' => 'onUserChange',
			'model.user.deleted' => 'onUserDeleted'
		];
	}
}
