<?php

namespace Baileylo\Blog\Post\Service\Publish;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostRepository;

class PublishService
{
    /** @var PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function publish(Post $post, \DateTime $publishDate)
    {
        $post->publish($publishDate);
        $this->postRepository->save($post);
    }
}
