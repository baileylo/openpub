<?php

namespace Baileylo\BlogApp\Controller\Auth;

use Baileylo\Core\Laravel\Validation\ValidationResponse;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class LoginHandler extends Controller
{
    /** @var AuthValidator */
    private $validator;

    /** @var Redirector */
    private $redirector;

    /**
     * @param AuthValidator $validator
     * @param Redirector    $redirector
     */
    public function __construct(AuthValidator $validator, Redirector $redirector)
    {
        $this->validator = $validator;
        $this->redirector = $redirector;
    }

    public function handle()
    {
        $data = \Input::only('login', 'password');

        $isValid = $this->validator->validate($data);
        if ($isValid instanceof ValidationResponse) {
            return $this->redirector->back()->withErrors($isValid->getErrors())->withInput($data);
        }

        return $this->redirector->intended('admin');
    }
}
