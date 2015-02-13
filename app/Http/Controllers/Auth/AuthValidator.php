<?php

namespace App\Http\Controllers\Auth;

use Baileylo\Core\Laravel\Validation\ValidationResponse;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Factory;

class AuthValidator
{
    /** @var Factory */
    protected $factory;

    /** @var AuthManager */
    private $auth;

    public function __construct(Factory $factory, AuthManager $auth)
    {
        $this->factory = $factory;
        $this->auth = $auth;
    }

    public function validate($data)
    {
        $validators = $this->factory->make($data, [
            'login' => 'required',
            'password' => 'required'
        ]);

        if ($validators->fails()) {
            return new ValidationResponse($validators->messages());
        }

        if (!$this->auth->attempt($data)) {
            return new ValidationResponse(new MessageBag(['login' => 'Invalid login password combination']));
        }

        return true;
    }
}
