<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Publication;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Report;
class AdminController extends Controller
{
    
    public function deleteUser(User $user)
    {
        
        foreach($user->publications as $publication)
        {
            $publication->likesCount()->delete();
            $publication->commentsCount()->delete();
            $publication->reportsCount()->delete();
        }
        $user->publications()->delete();
        $user->delete();
        return redirect('/adminHome/users')->with('deleted', true);
    }
    public function deletePub(Publication $publication)
    {
        if($publication->likes()->exists()){
            $publication->likes()->delete();
        }
        if($publication->reports()->exists()){
            $publication->reports()->delete();
        }
        if($publication->comments()->exists()){
            $publication->comments()->delete();
        }
        $publication->delete();
        return redirect('/adminHome/reports')->with('deleted', true);
    }
    public function ChangeRoles(User $user)
    {
        if($user->role =="admin")
        {
            $user->role = "user";
        }else{
            $user->role = "admin";
        }
        $user->save();
        $users = User::withCount('publications')->latest()->paginate(10);
        
        return redirect('/adminHome/users');
    }
    
}
