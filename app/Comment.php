<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [

        'author',
        'url',
        'body'

    ];
    protected $dates = [

        'created_at' => 'date:d-m-Y'
    ];
}

