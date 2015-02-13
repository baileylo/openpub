<?php

namespace App\Http\Controllers\Admin;

use Baileylo\Blog\Post\PostRepository;
use Baileylo\BlogApp\Pagination\LengthAwareRoutePaginator;
use Baileylo\BlogApp\Pagination\Paginate;
use Baileylo\BlogApp\Pagination\RoutePaginator;
use Baileylo\Core\Laravel\Renderable;
use App\Http\Controllers\Controller;
use Doctrine\ODM\MongoDB\Cursor;
use Illuminate\Contracts\Routing\UrlGenerator;

class ListView extends Controller
{
    use Renderable;

    const PUBLISHED_PAGE_SIZE = 15;

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
        $publishedPosts = $this->postRepo->findRecentPosts(self::PUBLISHED_PAGE_SIZE, ($page - 1) * self::PUBLISHED_PAGE_SIZE);
        $unpublishedPosts = $this->postRepo->findUnpublishedPosts(5, 0);

        $pagination = new LengthAwareRoutePaginator($publishedPosts->toArray(), $publishedPosts->count(), self::PUBLISHED_PAGE_SIZE, 'admin', $this->urlGenerator, $page);


        return $this->viewFactory()->make('admin.list', compact('publishedPosts', 'unpublishedPosts', 'pagination'));
    }
}
