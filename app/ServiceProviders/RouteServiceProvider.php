<?php

namespace Baileylo\BlogApp\ServiceProviders;

use Baileylo\BlogApp\Routing\CategoryResolver;
use Baileylo\BlogApp\Routing\PostResolver;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function register()
    {}

    public function boot()
    {
        /** @var \Illuminate\Routing\Router $router */
        $router = $this->app['router'];

        $router->bind('postSlug', PostResolver::class . '@postSlug');
        $router->bind('category', CategoryResolver::class . '@category');
    }
}
