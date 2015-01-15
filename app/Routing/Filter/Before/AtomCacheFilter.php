<?php

namespace Baileylo\BlogApp\Routing\Filter\Before;

use Baileylo\Blog\Site\Site;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;

class AtomCacheFilter
{
    /** @var Site */
    protected $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function filter(Route $route, Request $request)
    {
        $response = new Response();
        $response->setLastModified($this->site->getFeedLastModified());
        $response->setPublic();

        if ($response->isNotModified($request)) {
            return $response;
        }
    }
}
