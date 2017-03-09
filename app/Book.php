<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function userBooks()
    {
        return $this->hasMany(UserBook::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_book');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
