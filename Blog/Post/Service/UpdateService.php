<?php

namespace Baileylo\Blog\Post\Service;

use Baileylo\Blog\Category\Category;
use Baileylo\Blog\Post\Post;
use Baileylo\Core\Markdown\Markdown;

class UpdateService implements PostService
{
    /** @var PostService */
    private $innerService;
    /** @var Markdown */
    private $converter;

    public function __construct(PostService $innerService, Markdown $converter)
    {
        $this->innerService = $innerService;
        $this->converter = $converter;
    }

    /**
     * @param Post  $post
     * @param array $data Optional - list of new data points
     *
     * @return ServiceResponse
     */
    public function handle(Post $post, array $data = [])
    {
        $post->update($data['title'], $data['description'], $data['body'], $this->converter);

        $categoryNames = array_unique(
            array_map(function ($categoryName) {
                return trim($categoryName);
            }, explode(',', $data['categories']))
        );

        $post->getCategories()->clear();
        foreach ($categoryNames as $categoryName) {
            $post->addCategory(new Category($categoryName));
        }

        return $this->innerService->handle($post, $data);
    }
}
