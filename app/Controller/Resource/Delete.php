<?php

namespace Baileylo\BlogApp\Controller\Resource;

use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Page\PageRepository;
use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostRepository;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class Delete extends Controller
{
    /** @var Redirector */
    private $redirector;
    /** @var PageRepository */
    private $pageRepo;
    /** @var PostRepository */
    private $postRepo;

    public function __construct(Redirector $redirector, PageRepository $pageRepo, PostRepository $postRepo)
    {
        $this->redirector = $redirector;
        $this->pageRepo = $pageRepo;
        $this->postRepo = $postRepo;
    }

    public function delete($resource)
    {
        return $resource instanceof Page ? $this->deletePage($resource) : $this->deletePost($resource);
    }

    private function deletePost(Post $post)
    {
        $this->postRepo->delete($post);
        return $this->redirector->back()->with('action', 'Post deleted');
    }

    private function deletePage(Page $page)
    {
        $this->pageRepo->delete($page);
        return $this->redirector->back()->with('action', 'Page deleted');
    }
}
