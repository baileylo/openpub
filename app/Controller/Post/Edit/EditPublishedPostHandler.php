<?php

namespace Baileylo\BlogApp\Controller\Post\Edit;

use Baileylo\Blog\Post\Post;
use Baileylo\BlogApp\Post\UpdatePostService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class EditPublishedPostHandler extends Controller
{
    /** @var Redirector */
    private $redirector;

    /** @var Request */
    private $request;

    /** @var UpdatePostService */
    private $updateService;

    public function __construct(Redirector $redirector, Request $request, UpdatePostService $updateService)
    {
        $this->redirector = $redirector;
        $this->request = $request;
        $this->updateService = $updateService;
    }

    public function handle($date, Post $post)
    {
        $response = $this->updateService->handle($post, $this->request->all());

        if ($response->hasErrors()) {
            return $this->redirector->back()->withInput()->withErrors($response->getErrors());
        }

        return $this->redirector->back()->with('postUpdated', true);
    }
}
