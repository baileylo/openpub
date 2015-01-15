<?php

namespace Baileylo\Core\Markdown;


interface Markdown
{
    /**
     * Converts a string of markdown into HTML.
     *
     * @param String $markdown
     *
     * @return string
     */
    public function toHtml($markdown);
} 
