<?php

$autoload = [
    'SBWebApplication\\Auth\\' => '/app/modules/auth/src',
    'SBWebApplication\\Config\\' => '/app/modules/config/src',
    'SBWebApplication\\Cookie\\' => '/app/modules/cookie/src',
    'SBWebApplication\\Database\\' => '/app/modules/database/src',
    'SBWebApplication\\Filesystem\\' => '/app/modules/filesystem/src',
    'SBWebApplication\\Filter\\' => '/app/modules/filter/src',
    'SBWebApplication\\Migration\\' => '/app/modules/migration/src',
    'SBWebApplication\\Package\\' => '/app/modules/package/src',
    'SBWebApplication\\Routing\\' => '/app/modules/routing/src',
    'SBWebApplication\\Session\\' => '/app/modules/session/src',
    'SBWebApplication\\Tree\\' => '/app/modules/tree/src',
    'SBWebApplication\\View\\' => '/app/modules/view/src'
];

$path = realpath(__DIR__.'/../../../../../');
$loader = require $path.'/autoload.php';

foreach ($autoload as $namespace => $src) {
    $loader->addPsr4($namespace, $path.$src);
}
