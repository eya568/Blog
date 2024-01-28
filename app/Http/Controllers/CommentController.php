<?php

// CommentController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest; // Include the CommentRequest
use App\Models\Comment;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('publication.feed', compact('comments'));
    }

    public function store(CommentRequest $request,Publication $publication) 
    {
        $comment = Comment::create([
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
            'publication_id' => $publication->id,
        ]);
        return redirect()->back();
    }
}
