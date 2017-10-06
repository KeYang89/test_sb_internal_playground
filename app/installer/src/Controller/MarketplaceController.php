<?php

namespace SBWebApplication\Installer\Controller;

use SBWebApplication\Application as App;

/**
 * @Access("system: manage packages", admin=true)
 */
class MarketplaceController
{

    /**
     * @Request({"page":"int"})
     */
    public function newsAction($page = null)
    {
        return [
            '$view' => [
                'title' => __('Marketplace'),
                'name'  => 'installer:views/marketplace.php'
            ],
            '$data' => [
                'title' => 'News',
                'type' => 'sb_new_web_market_news',
                'api' => App::get('system_news.api'),
              //  'installed' => array_values(App::package()->all('sb_new_web_market_news')),
                'page' => $page
            ]
        ];
    }

    /**
     * @Request({"page":"int"})
     */
    public function goodsAction($page = null)
    {
        return [
            '$view' => [
                'title' => __('Marketplace'),
                'name'  => 'installer:views/marketplace.php'
            ],
            '$data' => [
                'title' => 'Goods',
                'type' => 'sb_new_web_market_goods',
                'api' => App::get('system_goods.api'),
               // 'installed' => array_values(App::package()->all('sb_new_web_market_goods')),
                'page' => $page
            ]
        ];
    }
}
