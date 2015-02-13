<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Baileylo\Blog\Post\PostRepository;
use Baileylo\BlogApp\Pagination\LengthAwareRoutePaginator;
use Baileylo\BlogApp\Pagination\Paginate;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Contracts\Routing\UrlGenerator;

class ListUnpublishedPosts extends Controller
{
    use Renderable;

    const PAGE_SIZE = 20;

    /** @var PostRepository */
    private $postRepo;

    /** @var UrlGenerator */
    private $urlGenerator;

    /**
     * @param PostRepository $postRepo
     * @param UrlGenerator   $urlGenerator
     */
    public function __construct(PostRepository $postRepo, UrlGenerator $urlGenerator)
    {
        $this->postRepo = $postRepo;
        $this->urlGenerator = $urlGenerator;
    }

    public function view($page = 1)
    {
        $posts = $this->postRepo->findUnpublishedPosts(self::PAGE_SIZE, $page);;

        $pagination = new LengthAwareRoutePaginator(
            $posts->toArray(),
            $posts->count(),
            self::PAGE_SIZE,
            'admin.unpublished',
            $this->urlGenerator,
            $page
        );

        return $this->viewFactory()->make('admin.list-unpublished', compact('posts', 'pagination'));
    }
}
