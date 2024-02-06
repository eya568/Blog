<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Http\Requests\StorePostRequest;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        
        return view('publication.create');
    }
    public function store(StorePostRequest $request)
    {
        $publication = new Publication();
        $publication->title = $request->input('title');
        $publication->content = $request->input('content');
        $publication->user_id = auth()->user()->id; 
        $publication->save();
        return redirect('/home');
    }
    public function destroy(Publication $publication)
    {
        $publication->likes()->delete();
        $publication->reports()->delete();
        $publication->delete();
        
        return redirect('/home')->with('deleted', true);
    }
    public function edit(Publication $publication){
        return view('publication.edit',compact('publication'));
    }
    public function update(StorePostRequest $request, Publication $publication)
    {
    $publication->update($request->validated());
    return redirect('/home');
    }


}
