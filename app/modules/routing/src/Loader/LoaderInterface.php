<?php

namespace SBWebApplication\Routing\Loader;

use SBWebApplication\Routing\Route;

interface LoaderInterface
{
    /**
     * Loads routes.
     *
     * @param  mixed $routes
     * @return Route[]
     */
    public function load($routes);
}
