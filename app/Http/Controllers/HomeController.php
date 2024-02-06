<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Report;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Publication $publications,User $user)
    {
    $user = auth()->user();

    if ($user->role == 'admin') 
    {
        
        $publications = Publication::with('user')->latest()->paginate(10);
        $users = User::withCount('publications')->latest()->paginate(10);
        return view('adminHome', compact('publications', 'users'));
    } 
    else
    {
        return view('home',compact('publications','user'));
    }
    }
 
    
    public function usersList()
    {
        $publications = Publication::with('user')->latest()->paginate(10);
        $users = User::withCount('publications')->latest()->paginate(10);

        return view('admin.users', compact('publications', 'users'));
    }

    public function reportsList()
    {
        $publications = Publication::with(['user','reports'])->latest()->paginate(10);
        $users = User::withCount('publications')->latest()->paginate(10);
        return view('admin.reports', compact('publications', 'users'));
    }

}