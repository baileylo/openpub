<?php

namespace Baileylo\BlogApp\Pagination;

use Baileylo\BlogApp\Pagination\Presenter\FullPresenter;
use Illuminate\Contracts\Pagination\Presenter;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

class RoutePaginator extends Paginator
{
    /**
     * Name of the route base route
     * @var String
     */
    protected $routeName;

    /** @var UrlGenerator */
    protected $urlGenerator;

    /** @var [] List of wild card replacements for the route */
    protected $routeParameters;

    /**
     * @param array|Collection $items        Items to paginator
     * @param int              $perPage      Items per page
     * @param int|null         $routeName    Name of the route to generate links with
     * @param UrlGenerator     $urlGenerator Object to generate links with
     * @param null             $currentPage  Current Page
     * @param array            $routeParameters
     */
    public function __construct(
        $items,
        $perPage,
        $routeName,
        UrlGenerator $urlGenerator,
        $currentPage = null,
        array $routeParameters = []
    ) {
        $this->items = $items instanceof Collection ? $items : Collection::make($items);
        $this->perPage = $perPage;
        $this->currentPage = $this->setCurrentPage($currentPage);
        $this->routeName = $routeName;
        $this->urlGenerator = $urlGenerator;
        $this->routeParameters = $routeParameters;

        $this->checkForMorePages();
    }

    protected function getRouteName($page)
    {
        if ($page > 1) {
            return $this->routeName . '.paginated';
        }

        return $this->routeName;
    }

    /**
     * Get a URL for a given page number.
     *
     * @param  int $page
     *
     * @return string
     */
    public function url($page)
    {
        if (!$page) {
            $page = 1;
        }

        $routeParameters = $this->routeParameters;

        if ($page > 1) { // if $page == 1 don't add it to url
            $routeParameters = $page;
        }

        return $this->urlGenerator->route($this->getRouteName($page), $routeParameters);
    }

    /**
     * Render the paginator using the given presenter.
     *
     * @param  \Illuminate\Contracts\Pagination\Presenter|null $presenter
     *
     * @return string
     */
    public function render(Presenter $presenter = null)
    {
        $presenter = $presenter ?: new FullPresenter($this);

        return $presenter->render();
    }
}
