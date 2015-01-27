<?php

namespace Baileylo\Blog\Page\Validator;

use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Validation\ValidationException;
use Illuminate\Validation\Factory;

class UpdatePageValidator
{
    /** @var Factory */
    private $factory;

    /**
     * @param Factory $factory Validation builder
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Validates the data for a new page
     *
     * @param Page   $page
     * @param string $slug
     * @param string $html HTML of the page
     *
     * @return bool True if data passed validation
     * @throws ValidationException
     */
    public function validate(Page $page, $slug, $html)
    {
        $validation = $this->factory->make(compact('slug', 'html'), [
            'slug' => "required|unique:Pages,slug,{$page->getId()}",
            'html' => 'required'
        ]);

        if ($validation->fails()) {
            throw new ValidationException($validation->errors());
        }

        return true;
    }
}
