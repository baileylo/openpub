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
        $router->filter('beforeResourceCache', Before\ResourceHttpCacheFilter::class);
        $router->filter('afterAtomCache', After\AtomCacheFilter::class);
        $router->filter('afterResourceCache', After\ResourceHttpCacheFilter::class);
        $router->filter('postUrlRedirect', Before\PostUrlRedirect::class);

        $router->filter('unpublishedResource', Before\UnpublishedResourceAccessFilter::class);

        $router->before(Before\LowerCaseUrlsFilter::class);
    }
}
