<?php

namespace App\Http\Controllers;

use App\Comment;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('welcome',[
            'comments' => $comments
        ]);

    }
    public function store()
    {
        request()->validate([
            'author' => ['required'],
            'body' => ['required'],
        ]);

        return Comment::create([
            'author' => request('author'),
            'url' => 'url',
            'body' => request('body'),
        ]);
        
    }
    
}