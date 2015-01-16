<?php

namespace Baileylo\BlogApp\Controller\Post\Edit;

use Baileylo\Blog\Post\Post;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Session\SessionManager;

class ViewPublishedPost extends Controller
{
    use Renderable;

    /** @var SessionManager|\Illuminate\Session\Store */
    private $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function view($date, Post $post)
    {
        $postUpdated = $this->session->has('postUpdated');
        $postPublished = $this->session->has('postPublished');

        return $this->viewFactory()
            ->make('post.edit.published', compact('post', 'postUpdated', 'postPublished'));
    }
}
