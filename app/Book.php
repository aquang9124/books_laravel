<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author_id'];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }

    public function author()
    {
    	return $this->belongsTo(Author::class);
    }

    public function reviews()
    {
    	return $this->hasMany(Review::class);
    }
}
