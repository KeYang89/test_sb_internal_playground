<?php

namespace SBWebApplication\Cache\Controller;

use SBWebApplication\Application as App;

/**
 * @Access(admin=true)
 */
class CacheController
{
    /**
     * @Request({"caches": "array"}, csrf=true)
     */
    public function clearAction($caches)
    {
        App::module('system/cache')->clearCache($caches);

        return ['message' => 'success'];
    }
}
