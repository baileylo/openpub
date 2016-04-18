<?php

namespace App\Services\Category;

use App\Category;

interface Repository
{
    /**
     * Find a given category by slug.
     * @param string $slug The category's slug
     * @return Category|null
     */
    public function findBySlug($slug);
}
