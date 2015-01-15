<?php

namespace Baileylo\Blog\Validation;

use Illuminate\Support\MessageBag;

interface ValidationResponse
{
    /**
     * @return MessageBag
     */
    public function getErrors();
}
