<?php

namespace Baileylo\BlogApp\Post\Validation;

use Baileylo\Blog\Validation\Validator;
use Baileylo\Core\Laravel\Validation\ValidationResponse;
use Illuminate\Validation\Factory;

class GenericValidator implements Validator
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
            'title' => 'required|min:5',
            'categories' => 'required',
            'description' => 'required',
            'body' => 'required'
        ]);

        return new ValidationResponse($validators->messages());
    }
}
