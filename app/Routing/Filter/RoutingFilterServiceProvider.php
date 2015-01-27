<?php

namespace Baileylo\BlogApp\Routing\Filter;

use Illuminate\Support\ServiceProvider;

class RoutingFilterServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        /** @var \Illuminate\Routing\Router $router */
        $router = $this->app['router'];
        $router->filter('beforeAtomCache', Before\AtomCacheFilter::class);
        $router->filter('beforePostCache', Before\PostCacheFilter::class);
        $router->filter('afterAtomCache', After\AtomCacheFilter::class);
        $router->filter('afterPostCache', After\PostCacheFilter::class);
        $router->filter('postUrlRedirect', Before\PostUrlRedirect::class);

        $router->before(Before\LowerCaseUrlsFilter::class);
    }
}
