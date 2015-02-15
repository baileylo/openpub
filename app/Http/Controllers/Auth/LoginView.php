<?php

namespace App\Http\Controllers\Auth;

use Baileylo\Core\Laravel\Renderable;
use App\Http\Controllers\Controller;

class LoginView extends Controller
{
    use Renderable;

    public function view()
    {
        return $this->viewFactory()->make('auth.login');
    }
}
