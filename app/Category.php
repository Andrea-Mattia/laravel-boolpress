<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * RELAZIONE CON POSTS
     */
    // categories - post
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
