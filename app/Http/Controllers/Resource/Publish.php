<?php

namespace App\Http\Controllers\Resource;

use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Page\Service\PagePublisherService;
use Baileylo\Blog\Page\Service\UpdatePageService;
use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\Service\Publish\PublishService;
use Baileylo\BlogApp\Post\UpdatePostService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;

class Publish extends Controller
{
    /** @var UpdatePageService */
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

    public function publish($resource)
    {
        $handler = $resource instanceof Page ? 'publishPage' : 'publishPost';
        return $this->$handler($resource);
    }

    private function publishPost(Post $post)
    {
        $this->postPublisher->publish($post, new \DateTime('-5 seconds'));
        return $this->redirector->back()->with('postPublished', true);
    }

    private function publishPage(Page $page)
    {
        $this->pagePublisher->publish($page);
        return $this->redirector->back()->with('action', 'Page updated');
    }
}
