<?php

namespace Baileylo\BlogApp\Routing;

use Baileylo\BlogApp\Routing\CategoryResolver;
use Baileylo\BlogApp\Routing\PostResolver;
use Illuminate\Support\ServiceProvider;

class RouteBindingServiceProvider extends ServiceProvider
{
    public function register()
    {}

    public function boot()
    {
        /** @var \Illuminate\Routing\Router $router */
        $router = $this->app['router'];

        $router->bind('category', CategoryResolver::class . '@category');
        $router->bind('slug', ResourceResolver::class . '@resource');
    }
}
