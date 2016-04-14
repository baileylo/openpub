<?php

namespace App\Http\Controllers;

use Illuminate\Routing\ResponseFactory;

class WelcomeController extends Controller
{
    public function welcome(ResponseFactory $responseFactory)
    {
        return $responseFactory->view('welcome');
    }
}
