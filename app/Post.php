<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content'
    ];

    /**
     * RELAZIONE CON CATEGORY
     */
    // post - categories
    public function posts() {
        return $this->belongsTo('App\Category');
    }
}
