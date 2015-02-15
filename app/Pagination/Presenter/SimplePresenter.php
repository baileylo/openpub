<?php

namespace Baileylo\BlogApp\Pagination\Presenter;

use Illuminate\Pagination\SimpleBootstrapThreePresenter;

class SimplePresenter extends SimpleBootstrapThreePresenter
{
    /**
     * Convert the URL window into Bootstrap HTML.
     *
     * @return string
     */
    public function render()
    {
        if ($this->hasPages())
        {
            $html = <<<HTML
    <div class="row hidden-for-small-down">
        <div class="columns large-6 medium-6">
            %s
        </div>
        <div class="columns large-6 medium-6 text-right">
            %s
        </div>
    </div>
    <div class="row visible-for-small-down">
        <div class="columns small-6">
            %s
        </div>
        <div class="columns small-6">
            %s
        </div>
    </div>
HTML;
            return sprintf(
                $html,
                $this->getPreviousButton('Newer', 'Newer'),
                $this->getNextButton('Older', 'Older'),
                $this->getPreviousButton('Newer', 'Newer', 'expand'),
                $this->getNextButton('Older', 'Older', 'expand')
            );
        }

        return '';
    }

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string  $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        return '';
    }

    /**
     * Get HTML wrapper for an available page link.
     *
     * @param  string      $url
     * @param  int         $page
     * @param  string|null $rel
     * @param string       $class List of classes to attach to the link
     *
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page, $rel = null, $class = '')
    {
        $rel = is_null($rel) ? '' : ' rel="'.$rel.'"';

        return '<a class="button '.$class.'" href="'.$url.'"'.$rel.'>'.$page.'</a>';
    }

    /**
     * Get the previous page pagination element.
     *
     * @param  string  $text
     * @param  String  $rel  The relative text for the link
     * @param  string  $class list of classes to attach to the link
     * @return string
     */
    protected function getPreviousButton($text = '&laquo;', $rel = 'prev',  $class = '')
    {
        // If the current page is less than or equal to one, it means we can't go any
        // further back in the pages, so we will render a disabled previous button
        // when that is the case. Otherwise, we will give it an active "status".
        if ($this->paginator->currentPage() <= 1)
        {
            return $this->getDisabledTextWrapper($text, $class);
        }

        $url = $this->paginator->url(
            $this->paginator->currentPage() - 1
        );

        return $this->getPageLinkWrapper($url, $text, 'prev', $class);
    }

    /**
     * Get the next page pagination element.
     *
     * @param  string  $text
     * @param  string  $class list of classes to attach to the link
     * @return string
     */
    protected function getNextButton($text = '&raquo;', $class = '')
    {
        // If the current page is greater than or equal to the last page, it means we
        // can't go any further into the pages, as we're already on this last page
        // that is available, so we will make it the "next" link style disabled.
        if ( ! $this->paginator->hasMorePages())
        {
            return $this->getDisabledTextWrapper($text, $class);
        }

        $url = $this->paginator->url($this->paginator->currentPage() + 1);

        return $this->getPageLinkWrapper($url, $text, 'next', $class);
    }

    /**
     * Get HTML wrapper for a page link.
     *
     * @param  string  $url
     * @param  int  $page
     * @param  string|null  $rel
     * @param  string  $class list of classes to attach to the link
     * @return string
     */
    protected function getPageLinkWrapper($url, $page, $rel = null, $class = '')
    {
        return $this->getAvailablePageWrapper($url, $page, $rel, $class);
    }
}
