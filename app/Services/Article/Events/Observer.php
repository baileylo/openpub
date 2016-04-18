<?php

namespace App\Services\Article\Events;

use App\Article\Article;
use App\Services\Article\CacheKeyChain;
use Illuminate\Cache\Repository as Cache;

class Observer
{
    /** @var Cache */
    protected $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function saved(Article $post)
    {
        $key = CacheKeyChain::get('full', $post->slug);
        $this->cache->forever($key, $post);
    }

    public function deleted(Article $post)
    {
        $key = CacheKeyChain::get('full', $post->slug);
        $this->cache->forget($key, $post);
    }
}
