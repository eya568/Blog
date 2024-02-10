<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Report;
use App\Http\Requests\ReportRequest;
use Illuminate\Support\Facades\Cookie;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(ReportRequest $request, Publication $publication)
{
    $user = auth()->user();

    // Look for an existing report
    $existingReport = Report::where('user_id', $user->id)
        ->where('publication_id', $publication->id)
        ->first();

    // If there is an existing report, set a cookie
    if ($existingReport) {
        
        return redirect()->back()->with('reported', true);
    }

    // Create a new report
    Report::create([
        'user_id' => $user->id,
        'publication_id' => $publication->id,
        'reason' => $request->input('reason'),
    ]);

    $expiration = 60 * 24 * 365; // 1 year in minutes
    cookie()->queue('reported_' . $publication->id.$user->id, true, $expiration); 
    return redirect()->back()->with('success', 'Post reported successfully.')->with('message', 'Reported');
}
    public function index()
    {
        
    }

}
