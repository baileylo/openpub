<?php

namespace Baileylo\BlogApp\Controller\Post\Delete;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostService;
use Baileylo\Blog\Post\Service\Delete\DeleteService;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class Delete extends Controller
{
    /** @var DeleteService */
    private $postService;
    /** @var Redirector */
    private $redirector;

    public function __construct(DeleteService $postService, Redirector $redirector)
    {
        $this->postService = $postService;
        $this->redirector = $redirector;
    }

    public function delete(Post $post)
    {
        $this->postService->delete($post);
        return $this->redirector->route('admin');
    }
}
