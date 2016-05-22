<?php

namespace App\Providers;

use App\Article\Page;
use App\Article\Post;
use App\Services\Article;
use App\Services\Category;
use App\Services\Pagination\FoundationFourPresenter;
use App\Services\Template\TemplateProvider;
use App\Site;
use App\Validators;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param Factory $validator
     */
    public function boot(Factory $validator)
    {
        Post::observe($this->app[Article\Events\Post::class]);
        Page::observe($this->app[Article\Events\Page::class]);

        \View::share('site', $this->app[Site::class]);

        $validator->extend('template', Validators\Template::class . '@validate');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

        $this->app->bind(TemplateProvider::class, function () {
            return $this->app->build(TemplateProvider::class, [
                'templateDirectory' => resource_path('views/post/templates')
            ]);
        });

        $this->app->bind(Site::class, function () {
            return new Site(
                env('SITE_TITLE', 'My Blog'),
                env('SITE_DESCRIPTION', 'A blog.'),
                env('SITE_GA_ID', null),
                env('SITE_FB_ID', null),
                env('SITE_TWITTER', null)
            );
        });

        $this->app->bind(Article\Repository::class, function ($app) {
            return new Article\Repository\Cache(
                $app[Article\Repository\Eloquent::class],
                $app[Repository::class]
            );
        });

        $this->app->bind(Category\Repository::class, function ($app) {
            return new Category\Repository\Cache(
                $app[Category\Repository\Eloquent::class],
                $app[Repository::class]
            );
        });
    }
}
