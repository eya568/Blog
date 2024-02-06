<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Publication;
use App\Models\User;

class LikeController extends Controller
{
    
    public function store(Publication $publication,User $user)
    {
        $user = auth()->user();
        $existingLike = Like::where('user_id',$user->id)
        ->where('publication_id',$publication->id)
        ->first();
        if($existingLike){
            $existingLike->delete();
        }else
        {
        $like = Like::create([
            'user_id' => $user->id,
            'publication_id' => $publication->id,
        ]);
        }
        return redirect()->back();
    }
    
}
