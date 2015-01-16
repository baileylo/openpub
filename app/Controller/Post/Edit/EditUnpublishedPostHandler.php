<?php

namespace Baileylo\BlogApp\Controller\Post\Edit;

    use Baileylo\Blog\Post\Post;
    use Baileylo\BlogApp\Post\UpdatePostService;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Illuminate\Routing\Redirector;

class EditUnpublishedPostHandler extends Controller
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

    public function handle(Post $post)
    {
        $response = $this->updateService->handle($post, $this->request->all());

        if ($response->hasErrors()) {
            return $this->redirector->back()->withInput()->withErrors($response->getErrors());
        }

        if ($post->isPublished()) {
            return $this->redirector
                ->route('admin.post.edit', [$post->getPublishDate()->format('Y/m/d'), $post->getSlug()])
                ->with('postPublished', true);
        }

        return $this->redirector->back()->with('postUpdated', true);
    }
}
