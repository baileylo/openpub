<?php

namespace Baileylo\BlogApp\Pagination;

class Factory extends \Illuminate\Pagination\Factory
{
    /**
     * Get a new paginator instance.
     *
     * @param  array    $items
     * @param  int      $total
     * @param int|null  $page
     * @param null      $routeName
     *
     * @param  int|null $perPage
     *
     * @return \Illuminate\Pagination\Paginator
     */
    public function make(array $items, $total, $perPage = null, $page = 1, $routeName = null)
    {
        $paginator = new Paginator($this, $items, $total, $perPage);
        $paginator->setupPaginationContext();
        $this->setPageName('page');
        $this->setCurrentPage($page);
        return $paginator;
    }
}
