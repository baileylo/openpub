<?php

namespace App\Http\Controllers\Home;

use Baileylo\Blog\Post\PostRepository;
use Baileylo\BlogApp\Pagination\Presenter\SimplePresenter;
use Baileylo\BlogApp\Pagination\RoutePaginator;
use Baileylo\Core\Laravel\Renderable;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\UrlGenerator;

class View extends Controller
{
    use Renderable;

    const PAGE_SIZE = 6;

    /** @var PostRepository */
    private $postRepository;

    /** @var UrlGenerator */
    private $urlGenerator;

    public function __construct(PostRepository $postRepository, UrlGenerator $urlGenerator)
    {
        $this->postRepository = $postRepository;
        $this->urlGenerator = $urlGenerator;
    }

    public function view($page = 1)
    {
        /** @var \Doctrine\ODM\MongoDB\Cursor $posts */
        $posts = $this->postRepository->findRecentPosts(self::PAGE_SIZE, ($page - 1) * self::PAGE_SIZE);
        $pagination = new RoutePaginator($posts, self::PAGE_SIZE, 'home', $this->urlGenerator, $page);

        return $this->viewFactory()->make('home.list', compact('posts', 'pagination'));
    }
}
