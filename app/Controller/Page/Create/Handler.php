<?php

namespace Baileylo\BlogApp\Controller\Page\Create;

use Baileylo\Blog\Page\Service\CreatePageService;
use Baileylo\Blog\Validation\ValidationException;
use Baileylo\BlogApp\Post\CreatePostService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class Handler extends Controller
{
    /** @var Request */
    private $request;

    /** @var CreatePageService */
    private $service;

    /** @var Redirector */
    private $redirector;

    public function __construct(Request $request, Redirector $redirector, CreatePageService $service)
    {
        $this->request = $request;
        $this->service = $service;
        $this->redirector = $redirector;
    }

    public function handleForm()
    {
        extract($this->request->only('slug', 'page', 'title', 'isPublished'));

        try {
            $page = $this->service->create($slug, $title, $page, $isPublished);
        } catch (ValidationException $e) {
            return $this->redirector->back()->withInput()->withErrors($e->getErrors());
        }

        return $this->redirector->route('resource.permalink', [$page->getSlug()]);
    }
}
