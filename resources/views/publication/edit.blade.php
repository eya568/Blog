@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit your post</div>
                <div class="card-body">
                <form action="/publications/{{$publication->id}}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                      <label  for="title">title</label>
                      <input  name="title" type="text" class="form-control" id="title"  placeholder="Enter title"  value="{{old('title') ?? $publication->title}}">
                      <small id="titleHelp" class="form-text text-muted">choose a meaningful title.</small>
                      @error('title') 
                      <p class="text-danger">{{$message}}</p> 
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">content</label>
                        <input name="content" type="text" class="form-control" id="content"  placeholder="Enter your content" value="{{old('content') ?? $publication->content}}">
                        <small id="contentHelp" class="form-text text-muted">write a meaningful post.</small>
                    </div>
                    @error('content') 
                    <p class="text-danger">{{$message}}</p> 
                    @enderror
                    <button type="submit" class="btn btn-primary">Edit publication</button>
                </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>
@endsection
