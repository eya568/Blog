@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-3 shadow-sm">
                    <div class="card-header"><h5 class="card-title">{{ __('Dashboard') }}</h5></div>
                    <div class="card-body">
                        
                        <a href="/publications/create" class="btn btn-dark btn-block">
                            <i class="fas fa-plus-circle mr-1"></i> Create a New Post
                        </a>
                    </div>
                </div>

                @foreach($publications as $publication)
                <div class="card mb-3 shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">{{ $publication->title }}</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! $publication->content !!}</p>
                        <p class="card-text">
                            <strong>Published by:</strong> {{ $publication->user->name }}
                            <span class="text-muted" style="font-size: 0.8em;">{{ $publication->created_at->toDateString() }}</span>
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div>
                            <a href="#commentsCollapse{{$publication->id}}" class="text-primary" data-toggle="collapse" aria-expanded="false" aria-controls="commentsCollapse{{$publication->id}}">
                                Comments <span class="">{{ count($publication->comments) }}</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center">
                            <form id="addLike" action="/publications/{{$publication->id}}/likes" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                    @if(app('App\Http\Controllers\LikeController')->hadLiked($publication)) 
                                    {{ count($publication->likes) }}
                                    <i class="fa fa-heart"  style="color:red" aria-hidden="true"></i>
                                    @else
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    {{ count($publication->likes) }}
                                    @endif
                                </button>
                            </form>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-light btn-sm btn-outline-secondary" data-toggle="modal" data-target="#reportModal{{$publication->id}}">
                                    @if(app('App\Http\Controllers\ReportController')->hadReported($publication))
                                        <i class="fa fa-flag" style="color:red" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-flag-o" aria-hidden="true"></i>
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="commentsCollapse{{$publication->id}}">
                        <div class="card card-body">
                            <ul class="list-group list-unstyled">
                                @forelse($publication->comments as $comment)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $comment->user->name ?? 'deleted_user'}}</strong>: {{ $comment->content }}
                                            </div>
                                            <div class="text-muted" style="font-size: 0.8em;">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item text-muted">No comments yet.</li>
                                @endforelse
                            </ul>
                            <form id="addComment" action="/publications/{{$publication->id}}/comments" method="POST" class="mt-2">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" class="form-control" id="content" name="content" placeholder="Add a comment" required style="height: 30px;" value="{{old('content')?? ' '}}">
                                    <button type="submit" class="btn btn-primary btn-sm ml-2" style="height: 30px;">Post</button>
                                </div>
                                @if(session()->has('status') && session('publication_id') == $publication->id)
                                    <div class="text-green-400">{{session()->get('status')}}</div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Report Form Modal -->
                <div class="modal fade" id="reportModal{{$publication->id}}" tabindex="-1" role="dialog" aria-labelledby="reportModal{{$publication->id}}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reportModal{{$publication->id}}Label">Report Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(app('App\Http\Controllers\ReportController')->hadReported($publication))
                                    <!-- Alert for already reported -->
                                    <div class="alert alert-danger" role="alert">
                                        You've already reported this post.
                                    </div>
                                @else
                                    <form action="/publications/{{$publication->id}}/reports" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="reason">Reason for Report:</label>
                                            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit Report</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{ $publications->links() }}
            </div>
        </div>
    </div>
@endsection
