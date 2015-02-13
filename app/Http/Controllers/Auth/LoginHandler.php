<?php

namespace App\Http\Controllers\Auth;

use Baileylo\Core\Laravel\Validation\ValidationResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class LoginHandler extends Controller
{
    /** @var AuthValidator */
    private $validator;

    /** @var Redirector */
    private $redirector;
    /** @var Request */
    private $request;

    /**
     * @param AuthValidator $validator
     * @param Redirector    $redirector
     */
    public function __construct(AuthValidator $validator, Redirector $redirector, Request $request)
    {
        $this->validator = $validator;
        $this->redirector = $redirector;
        $this->request = $request;
    }

    public function handle()
    {
        $data = $this->request->only('login', 'password');

        $isValid = $this->validator->validate($data);
        if ($isValid instanceof ValidationResponse) {
            return $this->redirector->back()->withErrors($isValid->getErrors())->withInput($data);
        }

        return $this->redirector->intended('admin');
    }
}
