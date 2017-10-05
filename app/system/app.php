<?php

use SBWebApplication\Application as App;
use SBWebApplication\Module\Loader\AutoLoader;
use SBWebApplication\Module\Loader\ConfigLoader;

$loader = require $path.'/autoload.php';

$app = new App($config);
$app['autoloader'] = $loader;

$app['module']->register([
    'packages/*/*/index.php',
    'app/modules/*/index.php',
    'app/installer/index.php',
    'app/system/index.php'
], $path);

$app['module']->addLoader(new AutoLoader($app['autoloader']));
$app['module']->addLoader(new ConfigLoader(require __DIR__.'/config.php'));
$app['module']->addLoader(new ConfigLoader(require $app['config.file']));
$app['module']->load('system');

$app->run();