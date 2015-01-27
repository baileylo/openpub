<?php

namespace Baileylo\Blog\Validation;

use Illuminate\Support\MessageBag;

class ValidationException extends \Exception
{
    /** @var MessageBag */
    private $errors;

    public function __construct(MessageBag $errors)
    {
        $this->errors = $errors;
    }
}
