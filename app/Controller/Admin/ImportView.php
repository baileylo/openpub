<?php

namespace Baileylo\BlogApp\Controller\Admin;

use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class ImportView extends Controller
{
    use Renderable;

    public function view()
    {
        return $this->viewFactory()->make('admin.import');
    }
}
