<?php

namespace App\Http\Controllers;

use App\Comment;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index($url)
    {
        $comments = Comment::where('url', base64_decode($url))->get();

        return $comments;

    }
    public function store()
    {
        request()->validate([
            'author' => ['required'],
            'body' => ['required'],
            'url' => ['required'],
        ]);

        return Comment::create([
            'author' => request('author'),
            'url' => request('url'),
            'body' => request('body'),

        ]);
        
    }
    
}