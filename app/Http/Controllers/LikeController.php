<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Publication;

class LikeController extends Controller
{
    
    public function store(Publication $publication)
    {
        $like = Like::create([
            'user_id' => auth()->user()->id,
            'publication_id' => $publication->id,
        ]);
        return redirect()->back();
    }
}
