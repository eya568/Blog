<?php

namespace App\Http\Controllers;
use App\Models\Publication;
use App\Models\Report;
use App\Http\Requests\ReportRequest;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReportRequest $request, Publication $publication)
    {
        $user = auth()->user();

        // // Look for an existing report
        // $existingReport = Report::where('user_id', $user->id)
        //     ->where('publication_id', $publication->id)
        //     ->first();

        // // If there is an existing report, set a session flag
        // if ($existingReport) {
        //     return redirect()->back()->with('reported', true);
        // }

        // Create a new report
        Report::create([
            'user_id' => $user->id,
            'publication_id' => $publication->id,
            'reason' => $request->input('reason'),
        ]);

        return redirect()->back()->with('success', 'Post reported successfully.');
    }
    Public function destroy(Publication $publication)
    {
        $publication->reports()->delete();
        return redirect()->back()->with('success','reports Deleted');
    }
    public function hadReported(Publication $publication)
    {
        $user = auth()->user();
        
        $existingReport = Report::where('user_id', $user->id)
            ->where('publication_id', $publication->id)
            ->first();
        
        return $existingReport ? true : false;
    }
}
