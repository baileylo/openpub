<?php

namespace Baileylo\BlogApp\Controller\Page\View;

use Baileylo\Blog\Page\PageRepository;
use Baileylo\BlogApp\Pagination\Paginate;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class ListView extends Controller
{
    use Renderable;

    const PAGE_SIZE = 20;

    /** @var PageRepository */
    private $pageRepository;

    /** @var Paginate */
    private $paginate;

    public function __construct(PageRepository $pageRepository, Paginate $paginate)
    {
        $this->pageRepository = $pageRepository;
        $this->paginate = $paginate;
    }

    public function view($page = 1)
    {
        $offset = ($page - 1) * self::PAGE_SIZE;
        $pages = $this->pageRepository->listPages(self::PAGE_SIZE, $offset);
        $pagination = $this->paginate->paginate($pages, self::PAGE_SIZE, 'admin.pages', $page);

        return $this->viewFactory()->make('page.list.list', compact('pages', 'pagination'));
    }
}
