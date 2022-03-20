<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'category_id',
        'cover'
    ];

    /**
     * RELAZIONE CON CATEGORY
     */
    // post - categories
    public function category() {
        return $this->belongsTo('App\Category');
    }

    /**
     * RELAZIONE CON TAGS
     */
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
