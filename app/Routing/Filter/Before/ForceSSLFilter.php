<?php

namespace Baileylo\BlogApp\Routing\Filter\Before;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;

/**
 * Forces insecure routes to SSL
 */
class ForceSSLFilter
{
    /** @var Redirector */
    private $redirector;

    public function __construct(Redirector $redirector)
    {
        $this->redirector = $redirector;
    }

    public function filter(Route $route, Request $request)
    {
        if (!$request->isSecure()) {
            return $this->redirector->secure($request->path());
        }
    }
}
