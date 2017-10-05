<?php

namespace SBWebApplication\User\Event;

use SBWebApplication\Application as App;
use SBWebApplication\Auth\Event\AuthenticateEvent;
use SBWebApplication\Auth\Exception\AuthException;
use SBWebApplication\Event\EventSubscriberInterface;

class LoginAttemptListener implements EventSubscriberInterface
{
    const DELAY     = 5;
    const ATTEMPTS  = 5;
    const CACHE_KEY = 'auth.login_attempts';

    /**
     * Prevent authentication attempts if time in between failed attempts is too short
     *
     * @param  AuthenticateEvent $event
     * @throws AuthException
     */
    public function onPreAuthenticate(AuthenticateEvent $event)
    {
        if (!$credentials = $event->getCredentials() or !isset($credentials['username'])) {
            return;
        }

        $attempts = App::cache()->fetch($this->getCacheKey($credentials['username'])) ?: [];

        if (count($attempts) > self::ATTEMPTS && time() - (int) array_pop($attempts) < self::DELAY) {
            throw new AuthException(__('Slow down a bit.'));
        }
    }

    /**
     * Save failed login attempts to cache
     *
     * @param AuthenticateEvent $event
     */
    public function onAuthFailure(AuthenticateEvent $event)
    {
        if (!$credentials = $event->getCredentials() or !isset($credentials['username'])) {
            return;
        }

        $key = $this->getCacheKey($credentials['username']);

        $attempts = App::cache()->fetch($key) ?: [];
        $attempts[] = time();

        App::cache()->save($key, $attempts);
    }

    /**
     * Reset failed login attempts after successful login
     *
     * @param AuthenticateEvent $event
     */
    public function onAuthSuccess(AuthenticateEvent $event)
    {
        if (!$credentials = $event->getCredentials() or !isset($credentials['username'])) {
            return;
        }

        App::cache()->delete($this->getCacheKey($credentials['username']));
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe()
    {
        return [
            'auth.pre_authenticate' => 'onPreAuthenticate',
            'auth.failure'          => 'onAuthFailure',
            'auth.success'          => 'onAuthSuccess'
        ];
    }

    protected function getCacheKey($username) {
        return self::CACHE_KEY.'_'.$username;
    }
}
