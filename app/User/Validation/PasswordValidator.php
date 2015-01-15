<?php

namespace Baileylo\BlogApp\User\Validation;

use Illuminate\Validation\Factory;

class PasswordValidator
{
    /** @var Factory */
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function validate($data)
    {
        $validators = $this->factory->make($data, [
            'password' => 'required|min:5',
            'categories' => 'required',
            'description' => 'required',
            'body' => 'required'
        ]);

        return new ValidationResponse($validators->messages());
    }
}
