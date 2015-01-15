<?php

namespace Baileylo\BlogApp\View\Composer;

use Baileylo\Blog\Site\Site;

class SiteComposer
{
    /** @var Site */
    private $site;

    /**
     * @param Site $site
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function compose($view)
    {
        return $view->with('site', $this->site);
    }
}
