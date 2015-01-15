<?php

namespace Baileylo\BlogApp\Post;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\Service\PostService;
use Baileylo\Blog\Post\Service\StackedService as BaseStackedService;

class StackedService extends BaseStackedService implements UpdatePostService, CreatePostService
{
    protected $innerService;

    public function __construct(PostService $innerService)
    {
        $this->innerService = $innerService;
    }

    public function handle(Post $post, array $data = [])
    {
        return $this->innerService->handle($post, $data);
    }

}
