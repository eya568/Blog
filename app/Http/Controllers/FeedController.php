<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Publication; 

class FeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = auth()->user();
        $publications = Publication::with('user')->latest()->paginate(10);

        return view('publication.feed', compact('publications','user'));
    }
    
}
