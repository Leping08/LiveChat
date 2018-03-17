<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function Author()
    {
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return '/the-good-stuff/'.$this->getAttribute('id').'/';
    }
}
