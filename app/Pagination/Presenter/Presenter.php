<?php

namespace Baileylo\BlogApp\Pagination\Presenter;

use Illuminate\Pagination\Presenter as LaravelPresenter;

class Presenter extends LaravelPresenter {

    public function getActivePageWrapper($text)
    {
        return '<a href="#" class="button small">' . $text . '</a>';
    }

    public function getDisabledTextWrapper($text)
    {
        return '';
    }

    public function getPageLinkWrapper($url, $page, $rel = null)
    {
        return sprintf('<a href="%s" class="button small">%s</a>', $url, $page);
    }

}
