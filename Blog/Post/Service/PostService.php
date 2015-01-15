<?php

namespace Baileylo\Blog\Post\Service;


use Baileylo\Blog\Post\Post;

interface PostService
{
    /**
     * @param Post  $post
     * @param array $data Optional - list of new data points
     *
     * @return ServiceResponse
     */
    public function handle(Post $post, array $data = []);
}
