<?php

namespace SBVideo\Video\Event;

use SBWebApplication\Application as App;
use SBVideo\Video\UrlResolver;
use SBWebApplication\Event\EventSubscriberInterface;

class RouteListener implements EventSubscriberInterface
{

    /**
     * Registers permalink route alias.
     */
    public function onConfigureRoute($event, $route)
    {
        if ($route->getName() == '@video/id') {
            App::routes()->alias(dirname($route->getPath()).'/{slug}', '@video/id', ['_resolver' => 'SBVideo\Video\UrlResolver']);
        }
    }

    /**
     * Clears resolver cache.
     */
    public function clearCache()
    {
        App::cache()->delete(UrlResolver::CACHE_KEY);
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe()
    {
        return [
            'route.configure' => 'onConfigureRoute',
            'model.project.saved' => 'clearCache',
            'model.project.deleted' => 'clearCache'
        ];
    }
}
