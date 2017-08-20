<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

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

    public function likes()
    {
        return $this->hasMany('App\Like', 'post_id', 'id');
    }

    public function my_like()
    {
        if (Auth::check())
        {
            $user_id = Auth::user()->id;
        } else
        {
            $user_id = -1;
        }
        return $this->hasOne('App\Like', 'post_id', 'id')
            ->where('user_id', '=', $user_id);
    }


}
