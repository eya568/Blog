@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3" >
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body" >
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-auto mb-2">
                                <a href="/publications/create" class="btn btn-dark btn-block">
                                    <i class="fas fa-plus-circle mr-1"></i> Create a New Post
                                </a>
                            </div>
                            <div class="col-auto">
                                <a href="/profile/edit" class="btn btn-dark btn-block">
                                    <i class="fas fa-edit mr-1"></i> Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>

                @forelse(auth()->user()->publications as $publication)
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">{{$publication->title}}</h5>
                            </div>
                            <div class="btn-group">
                                <!-- Three dots icon for dropdown -->
                                <button type="button" class="btn btn-sm btn-outline-secondary  fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                <!-- Dropdown menu -->
                                <div class="dropdown-menu">
                                    <button class="dropdown-item deletePub" data-bs-toggle="modal" data-bs-target="#deleteModal{{$publication->id}}" data-value="{{$publication->id}}">Delete</button>
                                    <form action="/publications/{{$publication->id}}/edit">
                                        <button type="submit" class="dropdown-item">Edit</button>
                                    </form>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{$publication->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this post: {{$publication->title}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="/publications/{{$publication->id}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <figure class="figure">
                            </figure>
                           
                                <li class="list-group-item">{!! $publication->content !!}</li>
                          
                        </div>

                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div>
                                <a href="#commentsCollapse{{ $publication->id }}" class="text-primary"
                                    data-toggle="collapse" aria-expanded="false"
                                    aria-controls="commentsCollapse{{ $publication->id }}">
                                    Comments <span class="">{{ count($publication->comments) }}</span>
                                </a>
                            </div>
                            <div class="btn-group">
                                <!-- Like Button -->
                                <form id="addLike" action="/publications/{{$publication->id}}/likes" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm">
                                        @if(app('App\Http\Controllers\LikeController')->hadLiked($publication)) 
                                            {{ count($publication->likes) }}
                                            <i class="fa fa-heart" style="color:red" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            {{ count($publication->likes) }}
                                        @endif
                                    </button>
                                </form>
                                <!-- Report Button -->
                                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#reportModal{{$publication->id}}">
                                    @if(app('App\Http\Controllers\ReportController')->hadReported($publication))
                                        <i class="fa fa-flag" style="color:red" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-flag-o" aria-hidden="true"></i>
                                    @endif
                                </button>
                            </div>
                        </div>
                        <!-- Comments Collapse -->
                        <div class="collapse" id="commentsCollapse{{ $publication->id }}">
                            <div class="card card-body mt-2">
                                <form id="addComment" action="/publications/{{ $publication->id }}/comments" method="POST" class="mt-2">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" class="form-control" id="comment" name="content" placeholder="Add a comment" required style="height: 30px;">
                                        <button type="submit" class="btn btn-primary btn-sm ml-2" style="height: 30px;">Post</button>
                                    </div>
                                </form>

                                <ul class="list-group list-unstyled mt-2">
                                    @forelse($publication->comments as $comment)
                                        <li class="list-group-item">
                                            <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                                        </li>
                                    @empty
                                        <li class="list-group-item">No comments yet.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                @empty
                    <div class="card mb-3">
                        <div class="card-header">Posts</div>
                        <div class="card-content">
                            <p class="p-3"> You haven't posted yet</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @section('scripts')
        <!-- MODAL -->
        <script>
            $(document).ready(function() {
                $('.deletePub').click(function(e) {
                    e.preventDefault();
                    var pub_id = $(this).data('value');
                    $('#deleteModal' + pub_id).modal('show');
                })
            })
        </script>
    @endsection
@endsection
