<?php

namespace Baileylo\Blog\Post\Service\Delete;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostRepository;

class DeleteService
{
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepo = $postRepository;
    }

    public function delete(Post $post)
    {
        $this->postRepo->delete($post);

        return true;
    }
}
