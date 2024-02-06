@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card text-center mb-3">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('adminHome') }}">statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.reports') }}">Reports</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">publication_id</th>
                            <th scope="col">number of reports</th>
                            <th scope="col">delete Post</th>
                            <th scope="col">details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($publications as $publication)
                        @if($publication->reports()->count() > 0)
                        <tr>
                            <th>{{$publication->user->id}}</th>
                            <td scope="row">{{ $publication->title}}</td>
                            <td>{{$publication->reports()->count()}}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportConfirm{{$publication->id}}">confirm reports</button>
                            </td>
                            <!--details button-->
                            <td><button type="button" class="btn btn-outline-secondary waves-effect px-3" data-bs-toggle="modal" data-bs-target="#Details{{$publication->id}}"><i class="fa fa-file-text"
                                aria-hidden="true"></i></button></td>
                        </tr>
                        @endif
                        @empty
                        <td class="fs-3" colspan="5">No reports yet</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Details -->
@foreach($publications as $publication)
<div class="modal fade bd-example-modal-lg"  id="Details{{$publication->id}}"  tabindex="-1" role="dialog" aria-labelledby="Details{{$publication->id}}Label" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Details{{$publication->id}}Label">Publication Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <p class="card-text" >{!! $publication->content !!}</p>
                    <p class="card-text">
                        <strong>Published by:</strong> {{ $publication->user->name }}
                        <span class="text-muted" style="font-size: 0.8em; display: block; margin-top: 5px;">
                            {{ $publication->created_at->toDateString() }}
                        </span>
                    </p>
                    <h5>Reports Reason submitted</h5>
                    <ol class="list-group list-group-numbered">
                        @forelse($publication->reports as $report)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{ $report->user->name ?? 'Deleted User' }}</div>
                                {{ $report->reason }}
                            </div>
                        </li>
                        @empty
                        <li>No reports yet.</li>
                        @endforelse
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal for Confirming Reports -->
@foreach($publications as $publication)
<div class="modal fade" id="reportConfirm{{$publication->id}}" tabindex="-1" role="dialog" aria-labelledby="reportConfirm{{$publication->id}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportConfirm{{$publication->id}}Label">Confirm Reports</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete {{$publication->title}} posted by {{$publication->user->name}}?</p>
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
@endforeach
@endsection
