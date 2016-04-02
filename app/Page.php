<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int       id
 * @property string    title
 * @property string    body
 * @property string     slug
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'body'];

    public static function findBySlug($slug)
    {
        return Page::whereSlug($slug)->first();
    }
}
