<?php

namespace Baileylo\BlogApp\Routing\Filter\Before;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LowerCaseUrlsFilter
{
    /** @var Redirector */
    protected $redirector;

    public function __construct(Redirector $redirector)
    {
        $this->redirector = $redirector;
    }

    public function filter(Request $request)
    {
        $path = $request->getPathInfo();
        if (!preg_match('/[A-Z]/', $path)) {
            // No Upper case letters, so do nothing.
            return;
        }

        if ($request->method() === 'GET') {
            $path = strtolower($path);
            return $this->redirector->to($path, 301);
        }

        throw new NotFoundHttpException;
    }
}
