@extends('layouts.app')

@section('content')
    <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
            <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Users</h4>
                    </div>
                    <div class="card-body py-4">
                        <form method="POST"
                            action="{{ isset($user) ? route('users.update', ['user' => $user['id']]) : route('users.store') }}">
                            @csrf

                            @if (isset($user))
                                @method('PUT')
                            @endif
                            <div class="form-group row mb-4">
                                <label for="name"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ isset($user) ? $user['name'] : '' }}" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="email"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="email" id="email"
                                        value="{{ isset($user) ? $user['email'] : '' }}" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="username"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="{{ isset($user) ? $user['username'] : '' }}" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="role"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control" name="role" id="role">
                                        <option value="staff"
                                            {{ isset($user) && $user['role'] == 'staff' ? 'selected' : '' }}>
                                            Staff
                                        </option>
                                        <option value="siswa"
                                            {{ isset($user) && $user['role'] == 'siswa' ? 'selected' : '' }}>
                                            Siswa
                                        </option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="password"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- JUSTIFY END -->
                            <div class="form-group row mb-4">
                                <label for="justify" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($user) ? 'Update' : 'Create' }}
                                    </button>
                                    <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
