<?php

namespace App\Services\Article;

class CacheKeyChain
{
    protected static $keychain = [
        'full' => 'article:slug:[categories]:%s'
    ];

    /**
     * @param string    $key_name   Name of the key to get
     * @param array  ...$key_values The list of values to set in the key
     *
     * @return string
     */
    public static function get($key_name, ...$key_values)
    {
        return sprintf(self::$keychain[$key_name], ...$key_values);
    }
}
