<?php

namespace App\Services\Article\Repository;

use App\Services\Article\CacheKeyChain;
use App\Services\Article\Repository;
use Illuminate\Contracts\Cache\Repository as CacheContract;

class Cache implements Repository
{
    /** @var Repository */
    private $repository;

    /** @var CacheContract */
    private $cache;

    public function __construct(Repository $repository, CacheContract $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    public function findBySlug($slug)
    {
        $cache_key = CacheKeyChain::get('full', $slug);
        return $this->cache->sear($cache_key, function() use ($slug) {
            return $this->repository->findBySlug($slug);
        });
    }
}
