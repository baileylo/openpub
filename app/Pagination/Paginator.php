<?php

namespace Baileylo\BlogApp\Pagination;

class Paginator extends \Illuminate\Pagination\Paginator
{
    /** @var String */
    protected $routeName;

    /** @var String */
    protected $urlParam;

    public function __construct(Factory $factory, array $items, $total, $perPage = null)
    {
        parent::__construct($factory, $items, $total, $perPage);
    }

    protected function getRouteName($page)
    {
        if ($page > 1) {
            return $this->routeName . '.paginated';
        }

        return $this->routeName;
    }

    /**
     * @param mixed $routeName
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;
    }



    /**
     * @param String $urlParam
     */
    public function setUrlParam($urlParam)
    {
        $this->urlParam = $urlParam;
    }

    /**
     * Get a URL for a given page number.
     *
     * @param  int  $page
     * @return string
     */
    public function getUrl($page)
    {
        $routeParameters = array();

        if ($page > 1) { // if $page == 1 don't add it to url
            $routeParameters[$this->urlParam] = $page;
        }

        return \URL::route($this->getRouteName($page), $routeParameters);
    }
}
