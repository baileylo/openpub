<?php

namespace Baileylo\BlogApp\Routing\Filter\Before;

use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Post\Post;
use Illuminate\Auth\AuthManager;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Prevents access to unpublished resources.
 */
class UnpublishedResourceAccessFilter
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

    public function filter(Route $route)
    {
        /** @var Page|Post $page */
        $page = $route->getParameter('slug');
        if ($this->manager->guest() && !$page->isPublished()) {
            throw new NotFoundHttpException;
        }
    }
}
