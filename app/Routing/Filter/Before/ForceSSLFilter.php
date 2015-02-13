<?php

namespace Baileylo\BlogApp\Routing\Filter\Before;

use Illuminate\Config\Repository;
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

    public function __construct(Redirector $redirector, Repository $config)
    {
        $this->redirector = $redirector;
        $this->config = $config;
    }

    public function filter(Route $route, Request $request)
    {
        if ($this->config['app.https'] && !$request->isSecure()) {
            return $this->redirector->secure($request->path());
        }
    }
}
