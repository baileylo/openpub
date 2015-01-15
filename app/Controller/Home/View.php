<?php

namespace Baileylo\BlogApp\Controller\Home;

use Baileylo\Blog\Post\PostRepository;
use Baileylo\BlogApp\Pagination\Paginate;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class View extends Controller
{
    use Renderable;

    const PAGE_SIZE = 6;

    /** @var PostRepository */
    private $postRepository;
    /** @var Paginate */
    private $paginate;

    public function __construct(PostRepository $postRepository, Paginate $paginate)
    {
        $this->postRepository = $postRepository;
        $this->paginate = $paginate;
    }

    public function view($page = 1)
    {
        /** @var \Doctrine\ODM\MongoDB\Cursor $posts */
        $posts = $this->postRepository->findRecentPosts(self::PAGE_SIZE, ($page - 1) * self::PAGE_SIZE);
        $pagination = $this->paginate->paginate($posts, self::PAGE_SIZE, 'home', $page);

        return $this->viewFactory()->make('home.list', compact('posts', 'pagination'));
    }
}
