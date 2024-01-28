@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/publications/create" class="btn btn-dark">Create a new post</a>
                </div>
            </div>
            
            @forelse(auth()->user()->publications as $pub)
            <div class="card mb-3">
                <div class="card-header">{{$pub->title}}</div>
                <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            <div>{{$pub->content}}</div>
                        </li>     
                </ul>

                <div class="card-footer">
                    <form action="/publications/{{$pub->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete post</button>
                    </form>
                    <form action="/publications/{{$pub->id}}/edit">
                        <button type="submit" class="btn btn-sm btn-outline-primary">Edit</button>

                    </form>
                </div>
            </div>
            @empty
            <div class="card mb-3">
                <div class="card-header">posts</div>
                <div class="card-content"><p>This user didn't post anything yet</p></div>
                            
            </div>
            @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
