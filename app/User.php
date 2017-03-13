<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'facebook_id', 'review_liciense', 'comment_liciense', 'level', 'language', 'score'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bookRequests()
    {
        return $this->hasMany(BookRequest::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function userBooks()
    {
        return $this->hasMany(UserBook::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'user_book');
    }

    public function follower()
    {
        return $this->hasMany(Following::class, 'follower_id', 'id');
    }

    public function following()
    {
        return $this->hasMany(Following::class, 'following_id', 'id');
    }
}
