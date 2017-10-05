<?php

namespace SBWebApplication\View\Helper;

use SBWebApplication\View\View;

abstract class Helper implements HelperInterface
{
    /**
     * @var View
     */
    protected $view;

    /**
     * {@inheritdoc}
     */
    public function register(View $view)
    {
        $this->view = $view;
    }
}
