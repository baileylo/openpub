<?php

namespace App\Providers;

use App\Services\Pagination\FoundationFourPresenter;
use App\Services\Template\TemplateProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        LengthAwarePaginator::presenter(function (Paginator $paginator) {
            return new FoundationFourPresenter($paginator);
        });
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
    }
}
