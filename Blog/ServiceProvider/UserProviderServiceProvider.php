<?php

namespace Baileylo\Blog\ServiceProvider;

use Baileylo\Blog\User\UserProvider;
use Baileylo\Blog\User\UserRepository;
use Illuminate\Auth\AuthManager;
use Illuminate\Hashing\HasherInterface;
use Illuminate\Support\ServiceProvider;
use Laracasts\CommanderEvents\EventDispatcher;

class UserProviderServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot()
    {
        $this->app[AuthManager::class]->extend('blog', function ($app) {
            return new UserProvider(
                $app[UserRepository::class],
                $app[EventDispatcher::class],
                $app[HasherInterface::class]
            );
        });
    }
}
