<?php

namespace Baileylo\Blog\ServiceProvider;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostRepository;
use Baileylo\Blog\Post\Repository\DoctrineODM;
use Baileylo\Blog\User\User;
use Baileylo\Blog\User\UserRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, function ($app) {
            return $app[DocumentManager::class]->getRepository(User::class);
        });

        $this->app->singleton(PostRepository::class, function ($app) {
            return new DoctrineODM($app[DocumentManager::class]->getRepository(Post::class));
        });
    }
}
