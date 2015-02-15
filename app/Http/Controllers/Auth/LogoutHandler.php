<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\AuthManager;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;

class LogoutHandler extends Controller
{
    /** @var AuthManager */
    private $auth;
    /** @var Redirector */
    private $redirector;

    public function __construct(AuthManager $auth, Redirector $redirector)
    {
        $this->auth = $auth;
        $this->redirector = $redirector;
    }

    public function logout()
    {
        $this->auth->logout();
        return $this->redirector->route('home');
    }
}
