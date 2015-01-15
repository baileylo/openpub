<?php

namespace Baileylo\BlogApp\Controller\Post\View;

use Baileylo\Blog\Post\Post;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class ViewUnpublishedPost extends Controller
{
    use Renderable;

    public function view(Post $post)
    {
        return $this->viewFactory()->make('post.view.unpublished', compact('post'));
    }
}
