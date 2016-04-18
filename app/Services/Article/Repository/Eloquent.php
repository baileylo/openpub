<?php

namespace App\Services\Article\Repository;

use App\Article\Article;
use App\Services\Article\Repository;

class Eloquent implements Repository
{
    public function findBySlug($slug)
    {
        return Article::findBySlug($slug);
    }
}
