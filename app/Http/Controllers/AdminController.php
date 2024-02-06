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
        return redirect('/admin/users')->with('deleted', true);
    }
    public function deletePub(Publication $publication)
    {
        $publication->likesCount()->delete();
        $publication->reportsCount()->delete();
        $publication->delete();
        return redirect('/admin/reportsCount')->with('deleted', true);
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
        
        return view('/admin/users',compact('users'));
    }
    public function chartData()
    {
        $commentsCount = Comment::count();
        $likesCount = Like::count();
        $reportsCount = Report::count();
        $usersCount = User::count();
        $reportsCount = Report::count();
        return response()->json(compact('commentsCount','likesCount','reportsCount','usersCount'));

    }
}
