<?php

namespace App\Http\Controllers\Page\View;

use Baileylo\Blog\Page\PageRepository;
use Baileylo\BlogApp\Pagination\LengthAwareRoutePaginator;
use Baileylo\Core\Laravel\Renderable;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\UrlGenerator;

class ListView extends Controller
{
    use Renderable;

    const PAGE_SIZE = 20;

    /** @var PageRepository */
    private $pageRepository;

    /** @var UrlGenerator */
    private $urlGenerator;

    public function __construct(PageRepository $pageRepository, UrlGenerator $urlGenerator)
    {
        $this->pageRepository = $pageRepository;
        $this->urlGenerator = $urlGenerator;
    }

    public function view($page = 1)
    {
        $offset = ($page - 1) * self::PAGE_SIZE;
        $pages = $this->pageRepository->listPages(self::PAGE_SIZE, $offset);
        $pagination = new LengthAwareRoutePaginator(
            $pages->toArray(),
            $pages->count(),
            self::PAGE_SIZE,
            'admin.pages',
            $this->urlGenerator,
            $page
        );

        return $this->viewFactory()->make('page.list.list', compact('pages', 'pagination'));
    }
}
