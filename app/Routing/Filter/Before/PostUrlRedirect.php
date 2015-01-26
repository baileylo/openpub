<?php

namespace Baileylo\BlogApp\Routing\Filter\Before;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Routing\UrlGenerator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostUrlRedirect
{
    /** @var Redirector */
    protected $redirector;

    /** @var UrlGenerator */
    private $urlGenerator;

    public function __construct(Redirector $redirector, UrlGenerator $urlGenerator)
    {
        $this->redirector = $redirector;
        $this->urlGenerator = $urlGenerator;
    }

    public function filter(Route $route, Request $request)
    {
        $url = $this->urlGenerator->route(
            'post.permalink',
            [$route->getParameter('postSlug')->getSlug()]
        );

        return $this->redirector->to($url, 301);
    }
}
