<?php

namespace Baileylo\BlogApp\ServiceProviders;

use Baileylo\Blog\Post\PostRepository;
use Baileylo\Blog\Site\Site;
use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Site::class, function ($app) {
            $updatedDate = $app[PostRepository::class]->getLastUpdatedDate();

            return new Site(
                $app['config']['site.lastModified'],
                is_null($updatedDate) ? $app['config']['site.lastModified'] : $updatedDate,
                $app['config']['site.title'],
                $app['config']['site.subHead']
            );
        });
    }
}
