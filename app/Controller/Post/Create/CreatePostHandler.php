<?php

namespace Baileylo\BlogApp\Controller\Post\Create;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\Service\Create\CreateService;
use Baileylo\BlogApp\Post\CreatePostService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

class CreatePostHandler extends Controller
{
    /** @var Request  */
    protected $request;

    /** @var Redirector */
    private $redirector;

    /** @var CreatePostService */
    private $creationService;

    public function __construct(Request $request, Redirector $redirector, CreatePostService $creationService)
    {
        $this->request = $request;
        $this->redirector = $redirector;
        $this->creationService = $creationService;
    }

    public function handle()
    {
        $post = new Post();
        $data = $this->request->only('title', 'description', 'categories', 'body', 'isPublished');

        $response = $this->creationService->handle($post, $data);

        if ($response->hasErrors()) {
            $this->redirector->back()->withInput()->withErrors($response->getErrors());
        }

        $post = $response->getPost();

        return $this->redirector->route('post.permalink', [$post->getSlug()]);
    }
}
