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

                @forelse(auth()->user()->publications as $publication)
                    <div class="card mb-3">
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
                        <ul class="list-group">
                            <li class="list-group-item">{!! $publication->content !!}</li>
                        </ul>

                        <div class="card-footer">
                            <div class="d-flex align-items-center">
                                <a href="#commentsCollapse{{$publication->id}}" class="text-primary" data-toggle="collapse" aria-expanded="false" aria-controls="commentsCollapse{{$publication->id}}">
                                    Comments <span class="">{{ count($publication->comments) }}</span>
                                </a>
                            </div>
                        
                            <div class="collapse" id="commentsCollapse{{$publication->id}}">
                                <form id="addComment" action="/publications/{{$publication->id}}/comments" method="POST" class="mt-2">
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
                                        <li>No comments yet.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        
                    </div>
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
        $(document).ready(function () {
            $('.deletePub').click(function (e) {
                e.preventDefault();
                var pub_id = $(this).data('value');
                $('#deleteModal' + pub_id).modal('show');
            })
        })
    </script>
    @endsection
@endsection
