<?php

namespace Baileylo\Blog\Post\Service;

use Baileylo\Blog\Category\Category;
use Baileylo\Blog\Post\Post;
use Illuminate\Support\Str;

class SlugService implements PostService
{
    /** @var UpdateService */
    private $innerService;

    public function __construct(PostService $innerService)
    {
        $this->innerService = $innerService;
    }

    /**
     * @param Post  $post
     * @param array $data Optional - list of new data points
     *
     * @return ServiceResponse
     */
    public function handle(Post $post, array $data = [])
    {
        $post->setSlug(Str::slug($data['title']));

        return $this->innerService->handle($post, $data);
    }
}
