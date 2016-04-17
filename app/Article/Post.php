<?php

namespace App\Article;

use App\Category;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property Category[]|Collection categories
 */
class Post extends Article
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'published_at', 'updated_at', 'slug', 'title', 'description', 'markdown', 'html', 'template', 'is_html'
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = ['type' => 'post'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PostScope);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_article', 'article_id');
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
