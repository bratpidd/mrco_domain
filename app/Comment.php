<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * App\Comment
 *
 * @property-read \App\User $author
 * @mixin \Eloquent
 */
class Comment extends Model
{
    public function author()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
