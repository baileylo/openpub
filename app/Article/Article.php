<?php

namespace App\Article;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int       id
 * @property string    author
 * @property string    title
 * @property string    markdown
 * @property string    html
 * @property string    slug
 * @property string    template
 * @property bool      is_html      Flag saying if the input mode was markdown or html
 * @property \DateTime updated_at
 * @property \DateTime published_at
 * @property string    description
 * @property bool      is_published
 */
abstract class Article extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'articles';

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

    /**
     * @return bool
     */
    public function getIsPublishedAttribute()
    {
        return $this->published_at && $this->published_at <= new \DateTime();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getResolver()
    {
        return self::$resolver;
    }
    /**
     * Find a post by its slug
     *
     * @param string $slug          The post's slug
     * @param array  $relationships A list of relationships to eager load.
     *
     * @return bool|Post|Page
     */
    public static function findBySlug($slug, array $relationships = ['user'])
    {
        if (get_called_class() === __CLASS__) {
            return Post::findBySlug($slug, $relationships) ?: Page::findBySlug($slug, $relationships);
        }

        /** @var static $article */
        $article = self::whereSlug($slug)->first();
        if (!$article) {
           return false;
        }

        if ($relationships) {
            $article->load($relationships);
        }

        return $article;
    }
}
