<?php

namespace Baileylo\Blog\Validation;

interface Validator
{
    /**
     * Validate a provided set of data fields
     *
     * @param mixed $data Data to be validated
     *
     * @return ValidationResponse
     */
    public function validate($data);
}
