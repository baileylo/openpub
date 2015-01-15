<?php

namespace Baileylo\Core\Markdown;

use League\CommonMark\CommonMarkConverter;

class CommonMarkBridge implements Markdown
{
    /** @var CommonMarkConverter */
    private $converter;

    /**
     * @param CommonMarkConverter $converter
     */
    public function __construct(CommonMarkConverter $converter)
    {
        $this->converter = $converter;
    }

    /**
     * Converts a string of markdown into HTML.
     *
     * @param String $markdown
     *
     * @return string
     */
    public function toHtml($markdown)
    {
        return $this->converter->convertToHtml($markdown);
    }
}
