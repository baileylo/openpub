<?php

namespace App\Services\Category\Repository;

use App\Category;
use App\Services\Category\Repository;

class Eloquent implements Repository
{
    public function findBySlug($slug)
    {
        return Category::find($slug);
    }
}
