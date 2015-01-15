<?php

namespace Baileylo\BlogApp\Controller\Post\Publish;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\Service\Unpublish\UnpublishService;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class Unpublish extends Controller
{
    /** @var PublishService */
    private $postService;

    /** @var Redirector */
    private $redirector;

    public function __construct(UnpublishService $unpublishService, Redirector $redirector)
    {
        $this->postService = $unpublishService;
        $this->redirector = $redirector;
    }

    public function unpublish(Post $post)
    {
        $this->postService->unpublish($post);
        return $this->redirector->route('admin');
    }
}
