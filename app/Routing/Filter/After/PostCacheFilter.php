<?php

namespace Baileylo\BlogApp\Routing\Filter\After;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;

class PostCacheFilter
{
    const ONE_DAY = 86400;

    /** @var AuthManager */
    protected $auth;

    public function __construct(AuthManager $authManager)
    {
        $this->auth = $authManager;
    }

    public function filter(Route $route, Request $request, Response $response)
    {
        if ($this->auth->check()) {
            // If the user is logged in, don't cache.
            return $response;
        }

        /** @var \Baileylo\Blog\Post\Post|\Baileylo\Blog\Page\Page $post */
        $post = $route->getParameter('slug');

        $response->setLastModified($post->getUpdatedAt());
        $response->setVary('Accept-Encoding');
        $response->setPublic();
        $response->setMaxAge(self::ONE_DAY);

        return $response;
    }
}
