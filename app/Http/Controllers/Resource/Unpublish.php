<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Page\Service\PagePublisherService;
use Baileylo\Blog\Post\Service\Publish\PublishService;
use Illuminate\Routing\Redirector;

class Unpublish extends Controller
{
    /** @var PublishService */
    private $postPublisher;

    /** @var PagePublisherService */
    private $pagePublisher;

    /**
     * @param Redirector           $redirector
     * @param PublishService       $postPublisher
     * @param PagePublisherService $pagePublisher
     */
    public function __construct(Redirector $redirector, PublishService $postPublisher, PagePublisherService $pagePublisher)
    {
        $this->redirector = $redirector;
        $this->postPublisher = $postPublisher;
        $this->pagePublisher = $pagePublisher;
    }

    public function unpublish($resource)
    {
        $handler = $resource instanceof Page ? 'unpublishPage' : 'unpublishPost';
        return $this->$handler($resource);
    }

    private function unpublishPost(Post $post)
    {
        $this->postPublisher->back($post, new \DateTime('-5 seconds'));
        return $this->redirector->back()->with('postPublished', true);
    }

    private function unpublishPage(Page $page)
    {
        $this->pagePublisher->unpublish($page);
        return $this->redirector->back()->with('action', 'Page updated');
    }
}
