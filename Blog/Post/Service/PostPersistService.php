<?php

namespace Baileylo\Blog\Post\Service;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostRepository;

class PostPersistService implements PostService
{
    /** @var PostRepository */
    private $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function handle(Post $post, array $data = [])
    {
        $this->postRepo->save($post);

        return new ServiceResponse($post);
    }
}
