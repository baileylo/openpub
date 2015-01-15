<?php

namespace Baileylo\BlogApp\Post;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\Service\ServiceResponse;

interface CreatePostService
{
    /**
     * @param Post  $post
     * @param array $data
     *
     * @return ServiceResponse
     */
    public function handle(Post $post, array $data = []);
}
