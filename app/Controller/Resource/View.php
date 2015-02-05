<?php

namespace Baileylo\BlogApp\Controller\Resource;

use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Post\Post;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class View extends Controller
{
    use Renderable;

    public function view($resource)
    {
        return $resource instanceof Page ? $this->renderPage($resource) : $this->renderPost($resource);
    }

    protected function renderPage(Page $page)
    {
        return $this->viewFactory()->make('page.view.view', compact('page'));
    }

    protected function renderPost(Post $post)
    {
        return $this->viewFactory()->make('post.permalink', compact('post'));
    }
}
