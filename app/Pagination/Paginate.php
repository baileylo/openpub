<?php

namespace Baileylo\BlogApp\Pagination;

use Doctrine\ODM\MongoDB\Cursor;

class Paginate
{
    /** @var Factory */
    private $factory;

    public function __construct()
    {
        $this->factory = app('paginator');
    }

    public function paginate(Cursor $cursor, $pageSize, $route, $currentPage = 1, $urlParam = 'page')
    {
        $factory = clone $this->factory;
        $factory->setCurrentPage($currentPage);

        $paginator = new Paginator($factory, $cursor->toArray(), $cursor->count(), $pageSize);
        $paginator->setupPaginationContext();
        $paginator->setUrlParam($urlParam);
        $paginator->setRouteName($route);


        return $paginator;
    }
}
