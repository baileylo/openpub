<?php

namespace Baileylo\BlogApp\Routing;

use Baileylo\Blog\Post\PostRepository;
use Illuminate\Routing\Route;

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
        return $this->postRepository->findBySlug($slug);
        $date = $route->getParameter('date', false);
        if (!$date) {
            return $this->postRepository->findUnpublishedArticle($slug);
        }

        $date = date_create_from_format('Y/m/d', $date);

        return $this->postRepository->findPublishedArticle($slug, $date);
    }
}
