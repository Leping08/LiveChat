<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function Post()
    {
        $this->belongsTo(Post::class);
    }

    public function Author()
    {
        $this->belongsTo(User::class);
    }
}
