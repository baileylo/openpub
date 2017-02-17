<?php

namespace App\Http\Controllers;

class RedirectController extends Controller
{
    public function wordPressRedirects(...$params)
    {
        $slug = array_pop($params);
        return $this->responseFactory->redirectToRoute('resource', $slug);
    }
}
