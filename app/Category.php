<?php

namespace App;

use App\Article\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'slug';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['posts'];

    protected $fillable = ['slug', 'name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
