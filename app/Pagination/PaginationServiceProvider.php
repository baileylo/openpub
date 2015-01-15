<?php

namespace Baileylo\BlogApp\Pagination;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class PaginationServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('paginator', function (Application $app) {
            $paginator = $app[Factory::class];

            $app->refresh('request', $paginator, 'setRequest');

            return $paginator;
        });

        $this->app->bind('Illuminate\Pagination\Factory', Factory::class);

        $this->app->bind(Factory::class, function ($app) {
            $paginator = new Factory($app['request'], $app['view'], $app['translator']);
            $paginator->setViewName($app['config']['view.pagination']);

            return $paginator;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('paginator', Factory::class, 'Illuminate\Pagination\Factory');
    }

}
