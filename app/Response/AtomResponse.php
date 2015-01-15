<?php

namespace Baileylo\BlogApp\Response;

use Illuminate\Http\Response;

class AtomResponse extends Response
{
    /**
     * @param string $content
     */
    public function __construct($content)
    {
        parent::__construct(
            $content,
            200,
            ['Content-Type' => 'application/atom+xml; charset=UTF-8']
        );
    }
}
