<?php

namespace App\Article;

use App\Article\Post;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string body
 */
class Page extends Article
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = ['type' => 'page'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'markdown', 'html', 'template'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PageScope);
    }

    /**
     * Pages are published by default.
     *
     * @return bool
     */
    public function getIsPublishedAttribute()
    {
        return true;
    }
}
