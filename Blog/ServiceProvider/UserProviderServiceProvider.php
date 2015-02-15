<?php

namespace Baileylo\Blog\ServiceProvider;

use Baileylo\Blog\User\UserProvider;
use Baileylo\Blog\User\UserRepository;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Hashing\HasherInterface;
use Illuminate\Support\ServiceProvider;

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
                $app[Dispatcher::class],
                $app[Hasher::class]
            );
        });
    }
}
