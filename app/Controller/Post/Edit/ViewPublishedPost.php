<?php

namespace Baileylo\BlogApp\Controller\Post\Edit;

use Baileylo\Blog\Post\Post;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class ViewPublishedPost extends Controller
{
    use Renderable;

    public function view($date, Post $post)
    {
        return $this->viewFactory()->make('post.edit.published', ['post' => $post]);
    }
}
