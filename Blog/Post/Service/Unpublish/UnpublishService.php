<?php

namespace Baileylo\Blog\Post\Service\Unpublish;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostRepository;

class UnpublishService
{
    /** @var PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function unpublish(Post $post)
    {
        $post->unpublish();
        $this->postRepository->save($post);
    }
}
