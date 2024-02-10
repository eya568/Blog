<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

use DateTime;

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
    public function indexAdmin(Publication $publications,User $user)
    {
    $user = auth()->user();

    if ($user->role == 'admin') 
    {
        
        $publications = Publication::with('user')->latest()->paginate(10);
        $users = User::withCount('publications')->latest()->paginate(10);
        //todays data 
        $ldate = new DateTime('today');
        $commentsCount = Comment::whereDate('created_at', $ldate)->count();
        $publicationsCount = Publication::whereDate('created_at', $ldate)->count();
        $likesCount = Like::whereDate('created_at', $ldate)->count();
        $reportsCount = Report::whereDate('created_at', $ldate)->count();
        //total count
        $commentsTotal = Comment::count();
        $likesTotal = Like::count();
        $reportsTotal = Report::count();
        $publicationsTotal = Publication::count();
        $usersTotal = User::count();
        $adminsCount = User::where('role', 'admin')->count();
    // Create an array to hold all the data
    $data = [
        'publications' => $publications,
        'users' => $users,
        'commentsCount' => $commentsCount,
        'likesCount' => $likesCount,
        'reportsCount' => $reportsCount,
        'publicationsCount' => $publicationsCount,
        'commentsTotal' => $commentsTotal,
        'likesTotal' => $likesTotal,
        'reportsTotal' => $reportsTotal,
        'publicationsTotal' =>$publicationsTotal,
        'usersTotal' =>$usersTotal,
        'adminCount'=> $adminsCount
    ];


    // Pass the data array to the view
    return view('adminHome', compact('data'));
} 

    }

    public function indexProfile(Publication $publications,User $user)
    {
        return view('profile',compact('publications','user'));

    }
 
    
    public function usersList()
    {
        $publications = Publication::with('user')->latest()->paginate(10);
        $users = User::withCount('publications')->latest()->paginate(10);

        return view('admin.users', compact('publications', 'users'));
    }

   public function reportsList()
{
    $publications = Publication::with(['user', 'reports'])->latest()->paginate(10);
    $users = User::withCount('publications')->latest()->paginate(10);
    // Group reports by publication ID
    $reports = DB::table('reports')
        ->select('publication_id', DB::raw('count(*) as total_reports'))
        ->groupBy('publication_id')
        ->paginate(10);
    return view('admin.reports', compact('publications', 'users', 'reports'));
}

}