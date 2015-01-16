<?php

namespace Baileylo\Blog\Post\Service;

use Baileylo\Blog\Post\Post;

class StackedService implements PostService
{
    private $innerService;

    public function __construct(PostService $innerService)
    {
        $this->innerService = $innerService;
    }

    public function handle(Post $post, array $data = [])
    {
        return $this->innerService->handle($post, $data);
    }
}
