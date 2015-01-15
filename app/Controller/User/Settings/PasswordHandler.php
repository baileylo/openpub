<?php

namespace Baileylo\BlogApp\Controller\User\Settings;

use Baileylo\Blog\User\Service\UserService;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Validator;

class PasswordHandler extends Controller
{
    use Renderable;

    /** @var AuthManager */
    protected $auth;

    /** @var Request */
    private $request;

    /** @var Redirector */
    private $redirector;

    /** @var UserService */
    private $userService;

    /** @var SessionManager */
    private $session;

    public function __construct(AuthManager $auth, Request $request, Redirector $redirector, UserService $userService, SessionManager $session)
    {
        $this->auth = $auth;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->userService = $userService;
        $this->session = $session;
    }

    public function handleForm()
    {
        $data = $this->request->only('password', 'confirm');
        $validator = Validator::make($data, [
            'password' => 'required|min:8',
            'email' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            $this->redirector->back()->withErrors($validator->getMessages(), 'password')->withInput();
        }

        $this->userService->updatePassword(\Auth::user(), $data['password']);

        $this->session->flash('passwordUpdated', true);
        $this->session->regenerate(true);

        return $this->redirector->back();
    }
}
