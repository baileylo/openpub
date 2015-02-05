<?php

namespace Baileylo\Blog\Page\Service\Validator;

use Baileylo\Blog\Validation\ValidationException;
use Baileylo\Core\Laravel\Validation\ValidationResponse;
use Illuminate\Validation\Factory;

class NewPageValidator
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
     * @param string $slug
     * @param        $title
     * @param string $html HTML of the page
     *
     * @return bool True if data passed validation
     * @throws ValidationException
     */
    public function validate($slug, $title, $html)
    {
        $validation = $this->factory->make(compact('slug', 'title', 'html'), [
            'title' => 'required',
            'slug' => 'required|unique:Page,slug',
            'html' => 'required'
        ]);

        if ($validation->fails()) {
            throw new ValidationException($validation->errors());
        }

        return true;
    }
}
