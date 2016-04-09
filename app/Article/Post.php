<?php

namespace App\Article;

use App\Category;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property bool                  is_published
 * @property string                description
 * @property \DateTime published_at
 * @property Category[]|Collection categories
 */
class Post extends Article
{
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PostScope);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'published_at', 'updated_at', 'slug', 'title', 'description', 'markdown', 'html', 'template', 'is_html'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return bool
     */
    public function getIsPublishedAttribute()
    {
        return $this->published_at && $this->published_at <= new \DateTime();
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', new \DateTime())
            ->orderBy('published_at', 'desc');
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published_at', '>', new \DateTime())
            ->orWhere('published_at', null)
            ->orderBy('published_at', 'desc');
    }
}
