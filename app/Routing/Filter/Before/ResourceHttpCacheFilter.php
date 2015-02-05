<?php

namespace Baileylo\BlogApp\Routing\Filter\Before;

use Baileylo\Blog\Site\Site;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;

class ResourceHttpCacheFilter
{
    /** @var Site */
    protected $site;

    /** @var AuthManager */
    private $auth;

    public function __construct(AuthManager $authManager, Site $site)
    {
        $this->auth = $authManager;
        $this->site = $site;
    }

    public function filter(Route $route, Request $request)
    {
        if ($this->auth->check()) {
            return;
        }

        /** @var \Baileylo\Blog\Post\Post|\Baileylo\Blog\Page\Page $post */
        $post = $route->getParameter('slug');

        $response = new Response();
        $response->setLastModified($post->getUpdatedAt());
        $response->setPublic();

        if ($response->isNotModified($request)) {
            return $response;
        }
    }
}
