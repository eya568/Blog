@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Feed</h1>

        @foreach($publications as $publication)
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">{{ $publication->title }}</h5>
                    </div>
                    <div class="btn-group">
                        <form action="/publications/{{$publication->id}}/reports" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">Report</button>
                        </form>
                        <form action="/publications/{{$publication->id}}/likes" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Like</button>
                        </form>
                    </div>
                </div>                
                <div class="card-body">
                    <p class="card-text">{{ $publication->content }}</p>
                    <p class="card-text">Published by: {{ $publication->user->name }}</p>
                </div>
                <div class="card-footer">
                    <form action="/publications/{{$publication->id}}/comments" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="content" class="form-control" placeholder="Add a comment">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                    <ul class="list-group">
                        @foreach($publication->comments as $comment)
                            <li class="list-group-item">
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach

        {{ $publications->links() }} 
    </div>
@endsection
