<?php

namespace SBWebApplication\User\Event;

use SBWebApplication\Application as App;
use SBWebApplication\Auth\Event\LoginEvent;
use SBWebApplication\Event\EventSubscriberInterface;
use SBWebApplication\User\Model\User;

class UserListener implements EventSubscriberInterface
{
    /**
     * Updates user's last login time
     */
    public function onUserLogin(LoginEvent $event)
    {
        User::updateLogin($event->getUser());
    }

    public function onRoleDelete($event, $role)
    {
        User::removeRole($role);
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe()
    {
        return [
            'auth.login' => 'onUserLogin',
            'model.role.deleted' => 'onRoleDelete'
        ];
    }
}
