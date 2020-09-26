<?php

namespace App\Http\Controllers;

use App\Reply;
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
    public function indexReply($url)
    {
        $replies = Reply::where('url', base64_decode($url))->get();

        return $replies;

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
    public function repliesStore(Request $request)
    {

        request()->validate([
            'author' => ['required'],
            'body' => ['required'],
            'url' => ['required'],
            'comment_id' => ['required'],
        ]);

        return Reply::create([
            'author' => request('author'),
            'url' => request('url'),
            'body' => request('body'),
            'comment_id' => request('comment_id'),
        ]);
        
    }
}