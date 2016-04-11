<?php

namespace App\Validators;

use App\Services\Template\TemplateProvider;

class Template
{
    /** @var TemplateProvider */
    private $templateProvider;

    public function __construct(TemplateProvider $templateProvider)
    {
        $this->templateProvider = $templateProvider;
    }

    public function validate($attributes, $value)
    {
        return is_string($value) && in_array($value, $this->templateProvider->getTemplates());
    }
}
