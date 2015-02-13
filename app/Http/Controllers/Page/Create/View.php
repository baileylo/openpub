<?php

namespace App\Http\Controllers\Page\Create;

use Baileylo\Core\Laravel\Renderable;
use App\Http\Controllers\Controller;

class View extends Controller
{
    use Renderable;

    public function view()
    {
        return $this->viewFactory()->make('page.create.create');
    }
}
