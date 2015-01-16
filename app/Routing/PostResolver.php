<?php

namespace Baileylo\BlogApp\Routing;

use Baileylo\Blog\Post\PostRepository;
use Illuminate\Routing\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostResolver
{
    /** @var PostRepository */
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function postSlug($slug, Route $route)
    {
        $post = $this->postRepository->findBySlug($slug);

        if (!$post) {
            throw new NotFoundHttpException;
        }

        return $post;
    }
}
