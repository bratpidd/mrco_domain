<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Post
 *
 * @property-read \App\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @mixin \Eloquent
 */
class Post extends Model
{
    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id');
    }

    public function author()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
