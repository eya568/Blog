@extends('layouts.app')
@section('content')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col mx-auto">
                    <div class="p-4 bg-white shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="max-w-xl">
                            <section class="col-6">
                                <header>
                                    <h2 class="h4 mb-3">Profile Information</h2>
                                    <p class="text-muted">Update your account's profile information and email address.</p>
                                </header>
                                <form method="post" action="/profile/update" class="mt-4">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                        @if ($errors->has('name'))
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" name="email" type="email" class="form-control"
                                            value="{{ old('email', $user->email) }}" required autocomplete="username">
                                        @if ($errors->has('email'))
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn btn-dark">Save</button>
                                    @if (session('status') === 'profile-updated')
                                        <p class="text-success mt-2">Saved.</p>
                                    @endif

                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col mx-auto">
                    <div class="p-4 bg-white shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="max-w-xl">
                            <section class="col-6">
                                <header>
                                    <h2 class="h4 mb-3">Update Password</h2>
                                    <p class="text-muted">Ensure your account is using a long, random password to stay
                                        secure.</p>
                                </header>
                                <form method="post" action="/password/update" class="mt-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <input id="current_password" name="current_password" type="password"
                                            class="form-control" autocomplete="current-password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password</label>
                                        <input id="password" name="password" type="password" class="form-control"
                                            autocomplete="new-password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input id="password_confirmation" name="password_confirmation" type="password"
                                            class="form-control" autocomplete="new-password">
                                    </div>

                                    <button type="submit" class="btn btn btn-dark">Save</button>
                                    @if (session('status') === 'password-updated')
                                        <p class="text-success mt-2">Saved.</p>
                                    @endif

                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 ">
        <div class="container">
            <div class="row">
                <div class="col mx-auto">
                    <div class="p-4 bg-white shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="max-w-xl">
                            <section class="space-y-6">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        Delete Account
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Once your account is deleted, all of its resources and data will be permanently
                                        deleted. Before deleting your account, please download any data or information that
                                        you wish to retain.
                                    </p>
                                </header>

                                <form method="post" action="{{ route('profile.destroy') }}" class="p-6"
                                    @if ($errors->userDeletion->isNotEmpty()) style="display: block;" @endif>
                                    @csrf
                                    @method('delete')

                                    <div class="mt-6">
                                        <label for="password" class="sr-only">Password</label>
                                        <input id="password" name="password" type="password" class="form-control mt-1"
                                            placeholder="Password">
                                        @if ($errors->userDeletion->has('password'))
                                            <div class="text-danger mt-2">{{ $errors->userDeletion->first('password') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-6 d-flex justify-content">
                                        
                                        <button type="submit" class="btn btn-danger mt-2">Delete Account</button>
                                    </div>
                                </form> 
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
