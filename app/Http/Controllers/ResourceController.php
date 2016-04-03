<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResourceController extends Controller
{
    /** @var Application */
    private $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function find($slug)
    {
        try {
            return $this->application->call(PostController::class . '@show', [$slug]);
        } catch (NotFoundHttpException $e) {
            return $this->application->call(PageController::class . '@show', [$slug]);
        }
    }
}
