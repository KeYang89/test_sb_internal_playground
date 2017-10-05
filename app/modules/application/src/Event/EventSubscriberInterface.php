<?php

namespace SBWebApplication\Event;

interface EventSubscriberInterface
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * @return array
     */
    public function subscribe();
}
