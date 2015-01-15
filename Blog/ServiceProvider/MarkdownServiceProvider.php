<?php

namespace Baileylo\Blog\ServiceProvider;

use Baileylo\Core\Markdown;
use Illuminate\Support\ServiceProvider;

class MarkdownServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Markdown\Markdown::class, function ($app) {
           return $app[Markdown\CommonMarkBridge::class];
        });
    }
}
