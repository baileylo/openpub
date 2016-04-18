<?php

namespace App\Http\Controllers;

class RedirectController extends Controller
{
    public function wordPressRedirects($date, $slug)
    {
        return $this->responseFactory->redirectToRoute('resource', $slug);
    }
}
