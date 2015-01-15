<?php

namespace Baileylo\Blog\Post\Service;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Validation\Validator;

class ValidationService implements PostService
{
    /** @var PostService */
    private $innerService;

    /** @var Validator */
    private $validator;

    /**
     * @param PostService $innerService
     * @param Validator   $validator
     */
    public function __construct(PostService $innerService, Validator $validator)
    {
        $this->innerService = $innerService;
        $this->validator = $validator;
    }

    /**
     * @param Post  $post
     * @param array $data Optional - list of new data points
     *
     * @return ServiceResponse
     */
    public function handle(Post $post, array $data = [])
    {
        $validation = $this->validator->validate($data);

        if ($validation->getErrors()->any()) {
            return new ServiceResponse($post, $validation);
        }

        return $this->innerService->handle($post, $data);
    }
}

