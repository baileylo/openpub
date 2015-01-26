<?php

namespace Baileylo\BlogApp\Pagination\Presenter;

use Illuminate\Pagination\Presenter as LaravelPresenter;

class Presenter extends LaravelPresenter {
    public function getPrevious($text = '&laquo;', $linkClasses = 'button small')
    {
        // If the current page is less than or equal to one, it means we can't go any
        // further back in the pages, so we will render a disabled previous button
        // when that is the case. Otherwise, we will give it an active "status".
        if ($this->currentPage <= 1)
        {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->paginator->getUrl($this->currentPage - 1);

        return $this->getPageLinkWrapper($url, $text, 'prev', $linkClasses);
    }

    public function getNext($text = '&raquo;', $linkClasses = 'button small')
    {
        if ($this->currentPage >= $this->lastPage)
        {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->paginator->getUrl($this->currentPage + 1);

        return $this->getPageLinkWrapper($url, $text, 'next', $linkClasses);
    }


    public function getActivePageWrapper($text)
    {
        return '<a href="#" class="button small">' . $text . '</a>';
    }

    public function getDisabledTextWrapper($text)
    {
        return '';
    }

    public function getPageLinkWrapper($url, $page, $rel = null, $class="")
    {
        return sprintf('<a href="%s" class="%s" rel="%s">%s</a>', $url, $class, $rel, $page);
    }

}
