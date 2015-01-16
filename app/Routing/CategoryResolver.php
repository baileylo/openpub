<?php

namespace Baileylo\BlogApp\Routing;

use Baileylo\Blog\Category\Category;
use Illuminate\Routing\Route;

class CategoryResolver
{
    public function category($categorySlug, Route $route)
    {
        return new Category($categorySlug);
    }
}
