<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Baileylo\Core\Laravel\Renderable;

class ImportView extends Controller
{
    use Renderable;

    public function view()
    {
        return $this->viewFactory()->make('admin.import');
    }
}
