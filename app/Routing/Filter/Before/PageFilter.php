<?php

namespace Baileylo\BlogApp\Routing\Filter\Before;

use Baileylo\Blog\Page\Page;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageFilter
{
    /** @var AuthManager */
    private $manager;
    /** @var Redirector */
    private $redirector;

    public function __construct(AuthManager $manager, Redirector $redirector)
    {
        $this->manager = $manager;
        $this->redirector = $redirector;
    }

    public function unpublished(Route $route)
    {
        /** @var Page $page */
        $page = $route->getParameter('pageSlug');
        if ($page->isPublished()) {
            return $this->redirector->route('page', [$page->getSlug()]);
        }
    }

    public function published(Route $route)
    {
        /** @var Page|Post $page */
        $page = $route->getParameter('slug');

        if ($this->manager->guest() && !$page->isPublished()) {
            throw new NotFoundHttpException;
        }
    }
}
