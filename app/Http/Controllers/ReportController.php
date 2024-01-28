<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Report;

class ReportController extends Controller
{
    //
    public function store(Publication $publication)
{
    //this mehtode will create a report on its first click delete it on the second click
    $user = auth()->user();
    //look for existing report
    $existingReport = Report::where('user_id', $user->id)
        ->where('publication_id', $publication->id)
        ->first();
    //if there is delete it
    if ($existingReport) {
        $existingReport->delete();
    } else {
        //create anew report
        $report = Report::create([
            'user_id' => $user->id,
            'publication_id' => $publication->id,
        ]);
    }

    return redirect()->back();
}

}
