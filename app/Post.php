<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string    markdown
 * @property string    html
 * @property string    author
 * @property bool      is_published
 * @property \DateTime published_at
 * @property string    description
 * @property string    title
 * @property string    slug
 * @property Category[]|Collection     categories
 */
class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'published_at', 'updated_at', 'slug', 'title', 'description', 'markdown', 'html'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'user_id', 'markdown'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['updated_at', 'published_at'];

    /**
     * Update the creation and update timestamps.
     *
     * @return void
     */
    protected function updateTimestamps()
    {
        $time = $this->freshTimestamp();

        if (! $this->isDirty(static::UPDATED_AT)) {
            $this->setUpdatedAt($time);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

    public static function scopePublished()
    {
        return static::where('published_at', '<=', new \DateTime())
            ->orderBy('published_at', 'asc');
    }

    public static function scopeUnpublished()
    {
        return static::where('published_at', '>', new \DateTime())
            ->orWhere('published_at', null)
            ->orderBy('published_at', 'desc');
    }

    /**
     * Find a post by its slug
     *
     * @param string $slug          The post's slug
     * @param array  $relationships A list of relationships to eager load.
     *
     * @return bool|Post
     */
    public static function findBySlug($slug, array $relationships = ['user'])
    {
        $post = Post::whereSlug($slug)->first();
        if (!$post) {
            return false;
        }

        if ($relationships) {
            $post->load($relationships);
        }

        return $post;
    }
}
