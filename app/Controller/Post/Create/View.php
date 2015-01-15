<?php

namespace Baileylo\BlogApp\Controller\Post\Create;

use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class View extends Controller
{
    use Renderable;

    public function view()
    {
        return $this->viewFactory()->make('post.create');
    }
}
