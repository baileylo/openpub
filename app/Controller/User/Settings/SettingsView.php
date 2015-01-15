<?php

namespace Baileylo\BlogApp\Controller\User\Settings;

use Baileylo\Core\Laravel\Renderable;
use Illuminate\Auth\AuthManager;
use Illuminate\Routing\Controller;
use Illuminate\Session\SessionManager;

class SettingsView extends Controller
{
    use Renderable;

    /** @var AuthManager */
    protected $auth;

    /** @var SessionManager */
    private $session;

    public function __construct(AuthManager $auth, SessionManager $session)
    {
        $this->auth = $auth;
        $this->session = $session;
    }

    public function view()
    {
        $data = [
            'user' => $this->auth->user(),
            'passwordUpdated' => $this->session->pull('passwordUpdated'),
            'settingsUpdated' => $this->session->pull('settingsUpdated')
        ];

        return $this->viewFactory()->make('user.settings', $data);
    }
}
