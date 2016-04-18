<?php

namespace App\Services\Article\Repository;

use App\Article;
use App\Services\Article\Repository;

class Eloquent implements Repository
{
    public function findBySlug($slug)
    {
        $article = Article\Article::findBySlug($slug);

        if ($article instanceof Article\Post) {
            $article->load(['categories']);
        }

        return $article;
    }
}
