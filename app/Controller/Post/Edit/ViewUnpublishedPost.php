<?php

namespace Baileylo\BlogApp\Controller\Post\Edit;

use Baileylo\Blog\Post\Post;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Session\SessionManager;

class ViewUnpublishedPost extends Controller
{
    use Renderable;

    /** @var SessionManager|\Illuminate\Session\Store */
    private $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function view(Post $post)
    {
        $postUpdated = $this->session->has('postUpdated');
        return $this->viewFactory()->make('post.edit.unpublished', compact('post', 'postUpdated'));
    }
}
