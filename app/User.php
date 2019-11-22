<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function info()
    {
        return $this->hasOne('App\Info', 'username', 'username');
    }

    public function following()
    {
        return $this->belongsToMany('App\User', 'followers', 'user_id', 'following_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'followers', 'following_id', 'user_id')->withTimestamps(); 
    }

    public function isFollowing($user)
    {
        return $this->following()->where('following_id', $user->id)->count();
    }

    public function getFollowing()
    {
        return $this->following()->where('user_id', $this->id)->latest()->get();
    }

    public function getFollowers()
    {
        return $this->followers()->where('following_id', $this->id)->latest()->get();
    }

}
