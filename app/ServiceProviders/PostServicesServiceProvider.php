<?php

namespace Baileylo\BlogApp\ServiceProviders;

use Baileylo\Blog\Post\PostRepository;
use Baileylo\Blog\Post\Service\PostPersistService;
use Baileylo\Blog\Post\Service\PublishService;
use Baileylo\Blog\Post\Service\ServiceStack;
use Baileylo\Blog\Post\Service\SlugService;
use Baileylo\Blog\Post\Service\UpdateService;
use Baileylo\Blog\Post\Service\ValidationService;
use Baileylo\BlogApp\Post\CreatePostService;
use Baileylo\BlogApp\Post\StackedService;
use Baileylo\BlogApp\Post\UpdatePostService;
use Baileylo\BlogApp\Post\Validation\GenericValidator;
use Baileylo\Core\Markdown\Markdown;
use Illuminate\Support\ServiceProvider;

class PostServicesServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UpdatePostService::class, function ($app) {
            $stack = new ServiceStack();
            $stack->push(ValidationService::class, $app[GenericValidator::class]);
            $stack->push(UpdateService::class, $app[Markdown::class]);
            $stack->push(PublishService::class);
            return new StackedService(
                $stack->resolve(new PostPersistService($app[PostRepository::class]))
            );
        });

        $this->app->bind(CreatePostService::class, function ($app) {
            $stack = new ServiceStack();
            $stack->push(ValidationService::class, $app[GenericValidator::class]);
            $stack->push(UpdateService::class, $app[Markdown::class]);
            $stack->push(SlugService::class);
            $stack->push(PublishService::class);
            return new StackedService(
                $stack->resolve(new PostPersistService($app[PostRepository::class]))
            );
        });
    }

    public function provides()
    {
        return [UpdatePostService::class, CreatePostService::class];
    }
}
