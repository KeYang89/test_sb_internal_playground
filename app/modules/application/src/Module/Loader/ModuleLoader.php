<?php

namespace SBWebApplication\Module\Loader;

use SBWebApplication\Application;

class ModuleLoader implements LoaderInterface
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * Constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function load($module)
    {
        $class = $module[is_string($module['main']) ? 'main' : 'class'];

        $module = new $class($module);
        $module->main($this->app);

        if (is_a($module, 'SBWebApplication\Event\EventSubscriberInterface')) {
            $this->app->subscribe($module);
        }

        return $module;
    }
}
