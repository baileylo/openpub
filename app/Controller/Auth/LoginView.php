<?php

namespace Baileylo\BlogApp\Controller\Auth;

use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class LoginView extends Controller
{
    use Renderable;

    public function view()
    {
        return $this->viewFactory()->make('auth.login');
    }
}
