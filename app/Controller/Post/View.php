<?php

namespace Baileylo\BlogApp\Controller\Post;

use Baileylo\Blog\Post\Post;
use Baileylo\BlogApp\Response\PostResponse;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class View extends Controller
{
    use Renderable;

    public function view(Post $post)
    {
        return $this->viewFactory()->make('post.permalink', compact('post'));
    }
}
