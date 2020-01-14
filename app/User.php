<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subscribed()
    {
        //return $this->hasManyThrough('App\Post', 'App\Subscription','user_id','user_id', 'id');
    }

    public function ifSubscribed($author_id)
    {
        $user_id = $this->id;
        $subscribed = Subscription::where('user_id', '=', $user_id)
            ->where('author_id', '=', $author_id)->count();
        return $subscribed;
    }
}
