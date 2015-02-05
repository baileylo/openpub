<?php

namespace Baileylo\BlogApp\Controller\Post\Publish;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\Service\Publish\PublishService;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class Publish extends Controller
{
    /** @var PublishService */
    private $postService;

    /** @var Redirector */
    private $redirector;

    public function __construct(PublishService $publishService, Redirector $redirector)
    {
        $this->postService = $publishService;
        $this->redirector = $redirector;
    }

    public function publish(Post $post)
    {
        $this->postService->publish($post, new \DateTime('-5 seconds'));
        return $this->redirector->route('admin');
    }
}
