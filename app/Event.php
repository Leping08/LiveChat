<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'desc'
    ];

    //TODO: Fix format
    protected $dates = [
        'date' => 'Y/d/m'
    ];
}
