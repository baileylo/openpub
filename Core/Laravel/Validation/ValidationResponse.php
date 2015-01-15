<?php

namespace Baileylo\Core\Laravel\Validation;

use Illuminate\Support\MessageBag;
use \Baileylo\Blog\Validation\ValidationResponse as BaseValidationResponse;

class ValidationResponse implements BaseValidationResponse
{
    protected $errors;

    /**
     * @param MessageBag $errors
     */
    public function __construct(MessageBag $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
