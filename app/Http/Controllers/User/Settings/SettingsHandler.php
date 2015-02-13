<?php

namespace App\Http\Controllers\User\Settings;

use Baileylo\Blog\User\Service\UserService;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Validator;

class SettingsHandler extends Controller
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

    public function __construct(
        Request $request,
        Redirector $redirector,
        UserService $userService,
        SessionManager $session
    ) {
        $this->request = $request;
        $this->redirector = $redirector;
        $this->userService = $userService;
        $this->session = $session;
    }

    public function handleForm()
    {
        $data = $this->request->only('name', 'email');

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($data, [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:User:email:' . $this->request->user()->getId()
        ]);

        if ($validator->fails()) {
            return $this->redirector->back()->withErrors($validator->errors(), 'settings')->withInput();
        }

        $this->userService->updateData($this->request->user(), $data['name'], $data['email']);

        $this->session->flash('settingsUpdated', true);

        return $this->redirector->back();
    }
}
