@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card text-center mb-3">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('adminHome') }}">Statistics</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link active" href="{{ route('admin.users') }}">Users</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.reports') }}">Reports</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Number of Posts</th>
                            <th scope="col">Total Reports Gotten</th>
                            <th scope="col">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ count($user->publications) }}</td>
                            <td>
                                @php
                                    $totalReports = 0;
                                @endphp
                                @foreach($user->publications as $publication)
                                    @php
                                        $totalReports += $publication->reports->count();
                                    @endphp
                                @endforeach
                                {{ $totalReports }}
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#confirmDelete{{$user->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                   
                                </button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#confirmRole{{$user->id}}">
                                    <i class="fa fa-edit"></i> 
                                </button>
                            </td>
                        </tr>
                        <!-- Delete User Modal -->
                        <div class="modal fade" id="confirmDelete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDelete{{$user->id}}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDelete{{$user->id}}Label">Confirm Deletion</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this user?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <form action="/users/{{$user->id}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Role Modal -->
                        <div class="modal fade" id="confirmRole{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmRole{{$user->id}}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmRole{{$user->id}}Label">Edit User Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Current Role: {{ $user->role }}</p>
                                        <form action="/admin/users/{{$user->id}}/changeRoles" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="newRole">New Role:</label>
                                                <select class="form-control" id="newRole" name="newRole">
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
    </div>
</div>
@endsection