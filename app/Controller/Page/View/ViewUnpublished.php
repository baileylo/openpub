<?php

namespace Baileylo\BlogApp\Controller\Page\View;

use Baileylo\Blog\Page\Page;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class ViewUnpublished extends Controller
{
    use Renderable;

    public function __construct()
    {

    }

    public function view(Page $page)
    {
        return $this->viewFactory()->make('page.view.view', compact('page'));
    }
}
