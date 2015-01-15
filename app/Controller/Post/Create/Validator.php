<?php

namespace Baileylo\BlogApp\Controller\Post\Create;

use Baileylo\Core\Laravel\Validation\ValidationResponse;
use Illuminate\Validation\Factory;

class Validator
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
            'body' => 'required',
            'isPublished' => 'required'
        ]);

        if ($validators->fails()) {
            return new ValidationResponse($validators->messages());
        }

        return true;
    }
}
