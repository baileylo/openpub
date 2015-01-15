<?php

namespace Baileylo\BlogApp\View;

use Baileylo\Blog\Site\Site;
use Baileylo\BlogApp\View\Composer\SiteComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        /** @var \Illuminate\View\Factory $view */
        $view = $this->app['view'];


        $view->composer('*', SiteComposer::class);
    }
}
