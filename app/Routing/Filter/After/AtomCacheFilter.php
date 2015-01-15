<?php

namespace Baileylo\BlogApp\Routing\Filter\After;

use Baileylo\Blog\Site\Site;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;

class AtomCacheFilter
{
    /** @var AuthManager */
    protected $auth;

    /** @var Site */
    protected $site;

    const ONE_DAY = 86400;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function filter(Route $route, Request $request, Response $response)
    {
        $response->setLastModified($this->site->getFeedLastModified());
        $response->setVary('Accept-Encoding');
        $response->setPublic();
        $response->setMaxAge(self::ONE_DAY);

        return $response;
    }
}
