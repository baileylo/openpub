<?php

namespace Baileylo\Core\Laravel;

trait Renderable
{
    /**
     * @return \Illuminate\View\Factory
     */
    protected function viewFactory()
    {
        return app('view');
    }
} 

