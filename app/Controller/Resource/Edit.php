<?php

namespace Baileylo\BlogApp\Controller\Resource;

use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Post\Post;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Session\SessionManager;

class Edit extends Controller
{
    use Renderable;

    /** @var SessionManager|\Illuminate\Session\Store */
    private $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function view($resource)
    {
        return $resource instanceof Page ? $this->renderEditPage($resource) : $this->renderEditPost($resource);
    }

    public function renderEditPage(Page $page)
    {
        return $this->viewFactory()
            ->make('page.edit.edit', compact('page'));
    }

    public function renderEditPost(Post $post)
    {
        $postUpdated = $this->session->has('postUpdated');
        $postPublished = $this->session->has('postPublished');

        return $this->viewFactory()
            ->make('post.edit.edit', compact('post', 'postUpdated', 'postPublished'));
    }
}
