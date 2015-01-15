<?php

namespace Baileylo\Blog\Post\Service;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Validation\ValidationResponse;
use Illuminate\Support\MessageBag;

class ServiceResponse
{
    /** @var Post */
    private $post;

    /** @var MessageBag */
    private $errors;

    public function __construct(Post $post, ValidationResponse $failure = null)
    {
        $this->post = $post;
        $this->errors = is_null($failure) ? new MessageBag() : $failure->getErrors();
    }

    public function getPost()
    {
        return $this->post;
    }

    public function hasErrors()
    {
        return $this->errors->any();
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
