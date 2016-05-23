<?php

namespace App\Services\Article;

use App\Article\Article;

interface Repository
{
    /**
     * @param string $slug The slug of the Article
     *
     * @return Article
     */
    public function findBySlug($slug);
}
