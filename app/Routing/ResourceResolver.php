<?php

namespace Baileylo\BlogApp\Routing;

use Baileylo\Blog\Page\PageRepository;
use Baileylo\Blog\Post\PostRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResourceResolver
{
    /** @var PageRepository */
    private $pageRepo;

    /** @var PostRepository */
    private $postRepo;

    public function __construct(PageRepository $pageRepo, PostRepository $postRepo)
    {
        $this->pageRepo = $pageRepo;
        $this->postRepo = $postRepo;
    }

    public function resource($slug)
    {
        $post = $this->getPost($slug);
        if ($post) {
            return $post;
        }

        $page = $this->getPage($slug);
        if ($page) {
            return $page;
        }

        throw new NotFoundHttpException;
    }

    private function getPost($slug)
    {
        return $this->postRepo->findBySlug($slug);
    }

    private function getPage($slug)
    {
        return $this->pageRepo->findBySlug($slug, false);
    }
}
