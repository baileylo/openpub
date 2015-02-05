<?php

namespace Baileylo\BlogApp\Routing\Filter\Before;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

/**
 * Forces insecure routes to SSL
 */
class ForceSSLFilter
{
    public function filter(Route $route, Request $request)
    {
        if (!$request->isSecure()) {
            return $request->secure($request->path());
        }
    }
}
