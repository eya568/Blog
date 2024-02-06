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

                @foreach($publications as $publication)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">{{ $publication->title }}</h5>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#reportModal{{$publication->id}}">
                                    Report
                                </button>
                                <form id="addLike" action="/publications/{{$publication->id}}/likes" method="POST">
                                    @csrf
                                    <!-- Replace the Like button with an image -->
                                    <button type="submit" class="btn btn-success btn-sm">
                                        Like {{ count($publication->likes) }}
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <p class="card-text">{!! $publication->content !!}</p>
                            <p class="card-text">
                                <strong>Published by:</strong> {{ $publication->user->name }}
                                <span class="text-muted" style="font-size: 0.8em; display: block; margin-top: 5px;">
                                   {{ $publication->created_at->toDateString() }}
                                </span>
                            </p>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex align-items-center">
                                <a href="#commentsCollapse{{$publication->id}}" class="text-primary" data-toggle="collapse" aria-expanded="false" aria-controls="commentsCollapse{{$publication->id}}">
                                    Comments <span class="">{{ count($publication->comments) }}</span>
                                </a>
                            </div>

                            <div class="collapse" id="commentsCollapse{{$publication->id}}">
                                <ul class="list-group list-unstyled mt-2">
                                    @forelse($publication->comments as $comment)
                                        <li class="list-group-item">
                                            <strong>{{ $comment->user->name ?? 'deleted_user'}}</strong>: {{ $comment->content }}
                                        </li>
                                    @empty
                                        <li>No comments yet.</li>
                                    @endforelse
                                </ul>
                            </div>

                            <form id="addComment" action="/publications/{{$publication->id}}/comments" method="POST" class="mt-2">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" class="form-control" id="comment" name="content" placeholder="Add a comment" required style="height: 30px;">
                                    <button type="submit" class="btn btn-primary btn-sm ml-2" style="height: 30px;">Post</button>
                                </div>
                            </form>
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
                                    @if(!Cookie::has('reported_' . $publication->id.$user->id))
                                        <form action="/publications/{{$publication->id}}/reports" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="reason">Reason for Report:</label>
                                                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit Report</button>
                                        </form>
                                    @else
                                        <!-- Alert for already reported -->
                                        <div class="alert alert-danger" role="alert">
                                            You've already reported this post.
                                        </div>
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
