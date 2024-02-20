<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Publication;
use App\Services\PublicationService;
class AdminController extends Controller
{
    protected $publicationService;

    public function __construct(PublicationService $publicationService)
    {
        $this->publicationService = $publicationService;
    }
    public function deleteUser(User $user)
    {

        foreach ($user->publications as $publication) {
            $this->publicationService->deletePublication($publication);
        }
        foreach ($user->reports as $report){
            $report->delete();
        }
        $user->delete();
        return redirect('/adminHome/users')->with('deleted', true);
    }
     
    public function ChangeRoles(User $user)
    {
        if ($user->role == "admin") {
            $user->role = "user";
        } else {
            $user->role = "admin";
        }
        $user->save();
        $users = User::withCount('publications')->latest()->paginate(10);

        return redirect('/adminHome/users');
    }
    public function searchUser(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $result = User::where('name', 'LIKE', '%' . $search . '%')->paginate(10);
            return view('admin.search', compact('search', 'result'));
        } else {
            $users = User::withCount('publications')->latest()->paginate(10);
            return view('admin.search', compact('users'));
        }
    }
}
