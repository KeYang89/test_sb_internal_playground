<?php

namespace SBWebApplication\Site\Controller;

use SBWebApplication\Application as App;
use SBWebApplication\Site\Model\Page;

/**
 * @Access("site: manage site")
 */
class PageApiController
{
    /**
     * @Route("/", methods="GET")
     */
    public function indexAction()
    {
        return array_values(Page::findAll());
    }

    /**
     * @Route("/{id}", methods="GET", requirements={"id"="\d+"})
     */
    public function getAction($id)
    {
        return Page::find($id);
    }
}
