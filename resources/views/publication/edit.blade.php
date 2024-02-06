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

                        <div>
                            <label for="title">Title</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="Enter title" value="{{ old('title') ?? $publication->title }}">
                            <small id="titleHelp" class="form-text text-muted">Choose a meaningful title.</small>
                            @error('title') 
                                <p class="text-danger">{{ $message }}</p> 
                            @enderror
                        </div>
                        
                        <div>
                            <label for="content">Content</label>
                            <textarea id="summernote" name="content" class="form-control" placeholder="Enter your content">{{ old('content') ?? $publication->content }}</textarea>
                            <small id="contentHelp" class="form-text text-muted">Write a meaningful post.</small>
                            @error('content') 
                                <p class="text-danger">{{ $message }}</p> 
                            @enderror
                        </div>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit publication</button>
                    
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to submit the changes you made to {{ $publication->title }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
