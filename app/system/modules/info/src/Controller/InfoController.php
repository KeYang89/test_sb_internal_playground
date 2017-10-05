<?php

namespace SBWebApplication\Info\Controller;

use SBWebApplication\Application as App;

/**
 * @Access(admin=true)
 */
class InfoController
{
    public function indexAction()
    {
        return [
            '$view' => [
                'title' => __('Info'),
                'name'  => 'system:modules/info/views/info.php'
            ],
            '$info' => App::info()->get()
        ];
    }
}
