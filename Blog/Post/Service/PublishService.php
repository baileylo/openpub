<?php

namespace Baileylo\Blog\Post\Service;

use Baileylo\Blog\Post\Post;

class PublishService implements PostService
{
    /** @var PostService */
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
        if (isset($data['isPublished'])) {
            $this->updatePublishStatus($post, $data['isPublished']);
        }

        return $this->innerService->handle($post, $data);
    }

    public function updatePublishStatus(Post $post, $isPublished) {
        if ($isPublished === 'yes') {
            $post->publish(new \DateTime('now'));
            return;
        }

        if ($isPublished === 'no') {
            $post->unpublish();
        }
    }
}
