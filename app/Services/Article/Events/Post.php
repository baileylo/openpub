<?php

namespace App\Services\Article\Events;

use App\Article\Article;
use App\Services\Article\CacheKeyChain;

class Post extends Observer
{
    public function saved(Article $post)
    {
        $key = CacheKeyChain::get('full', $post->slug);
        $post->load('categories');
        $this->cache->forever($key, $post);
    }
}
