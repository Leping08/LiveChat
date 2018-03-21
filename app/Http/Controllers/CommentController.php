<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'user_id' => 'required|integer',
            'post_id' => 'required|integer'
        ]);

        Comment::create($request->all());

        return back();
    }
}