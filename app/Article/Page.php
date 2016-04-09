<?php

namespace App\Article;

use App\Article\Post;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int       id
 * @property string    title
 * @property string    body
 * @property string    slug
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Page extends Article
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    protected $attributes = ['type' => 'page'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'markdown', 'html', 'template'];

    public static function boot()
    {
        parent::boot();

        // unset the post scope thing.
        unset(static::$globalScopes[static::class][PostScope::class]);

        static::addGlobalScope(new PageScope);
    }
}
