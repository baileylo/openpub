<?php

namespace Baileylo\BlogApp\Controller\Page\Create;

use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class View extends Controller
{
    use Renderable;

    public function view()
    {
        return $this->viewFactory()->make('page.create.create');
    }
}
