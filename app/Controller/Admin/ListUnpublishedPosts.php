<?php

namespace Baileylo\BlogApp\Controller\Admin;

use Baileylo\Blog\Post\PostRepository;
use Baileylo\BlogApp\Pagination\Paginate;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class ListUnpublishedPosts extends Controller
{
    use Renderable;

    const PAGE_SIZE = 20;

    /** @var PostRepository */
    private $postRepo;

    /** @var Paginate */
    private $paginate;

    /**
     * @param PostRepository $postRepo
     * @param Paginate       $paginate
     */
    public function __construct(PostRepository $postRepo, Paginate $paginate)
    {
        $this->postRepo = $postRepo;
        $this->paginate = $paginate;
    }

    public function view($page = 1)
    {
        $posts = $this->postRepo->findUnpublishedPosts(self::PAGE_SIZE, $page);;

        $pagination = $this->paginate->paginate($posts, self::PAGE_SIZE, 'admin.unpublished', $page);

        return $this->viewFactory()->make('admin.list-unpublished', compact('posts', 'pagination'));
    }
}
