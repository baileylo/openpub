<?php

namespace Baileylo\BlogApp\Controller\Admin;

use Baileylo\Blog\Post\PostRepository;
use Baileylo\BlogApp\Pagination\Paginate;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class ListView extends Controller
{
    use Renderable;

    const PUBLISHED_PAGE_SIZE = 15;

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
        $publishedPosts = $this->postRepo->findRecentPosts(self::PUBLISHED_PAGE_SIZE, ($page - 1) * self::PUBLISHED_PAGE_SIZE);
        $unpublishedPosts = $this->postRepo->findUnpublishedPosts(5, 0);

        $pagination = $this->paginate->paginate($publishedPosts, self::PUBLISHED_PAGE_SIZE, 'admin', $page);

        return $this->viewFactory()->make('admin.list', compact('publishedPosts', 'unpublishedPosts', 'pagination'));
    }
}
