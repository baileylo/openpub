<?php

namespace App\Services\Article;

interface Repository
{
    public function findBySlug($slug);
}
