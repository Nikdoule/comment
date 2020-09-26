<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [

        'author',
        'url',
        'body',
        'comment_id'

    ];
    protected $dates = [

        'created_at' => 'date:d-m-Y'
    ];

    public function replies()
    {
        return $this->belongsTo('App\Reply', 'comment_id');
    }
}
