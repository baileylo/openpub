<?php

namespace Baileylo\Blog\Page\Service;

use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Page\PageRepository;

class PagePublisherService
{
    /** @var PageRepository */
    private $repository;

    /**
     * @param PageRepository $repository
     */
    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function publish(Page $page)
    {
        $page->publish();
        $this->repository->save($page, true);
    }

    public function unpublish(Page $page)
    {
        $page->unpublish();
        $this->repository->save($page, true);
    }
}
