<?php

namespace Baileylo\BlogApp\Controller\Resource;

use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Page\PageRepository;
use Baileylo\Blog\Page\Service\UpdatePageService;
use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostRepository;
use Baileylo\Blog\Validation\ValidationException;
use Baileylo\BlogApp\Post\UpdatePostService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class EditHandler extends Controller
{
    /** @var Redirector */
    private $redirector;

    /** @var Request */
    private $request;

    /** @var UpdatePostService */
    private $postService;

    /** @var UpdatePageService */
    private $pageService;

    public function __construct(Request $request, Redirector $redirector, UpdatePageService $pageService, UpdatePostService $postService)
    {
        $this->redirector = $redirector;
        $this->request = $request;
        $this->postService = $postService;
        $this->pageService = $pageService;
    }

    public function handle($resource)
    {
        $handler = $resource instanceof Page ? 'editPage' : 'editPost';
        return $this->$handler($resource);
    }

    private function editPost(Post $post)
    {
        $response = $this->postService->handle($post, $this->request->all());

        if ($response->hasErrors()) {
            return $this->redirector->back()->withInput()->withErrors($response->getErrors());
        }

        return $this->redirector->back()->with('postUpdated', true);
    }

    private function editPage(Page $page)
    {
        $title = $this->request->get('title');
        $slug = $this->request->get('slug');
        $html = trim($this->request->get('html'));

        try {
            $this->pageService->update($page, $title, $slug, $html, $page->isPublished());
        } catch (ValidationException $e) {
            return $this->redirector->back()->withInput()->withErrors($e->getErrors());
        }

        return $this->redirector->back()->with('action', 'Page updated');
    }
}
