@extends('layouts.app')

@section('content')
    <div class="section-header">
        <h1>Students</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
            <div class="breadcrumb-item"><a href="{{ route('students.index') }}">Students</a></div>
            <div class="breadcrumb-item">
                {{ isset($student) ? 'Edit' : 'Create' }}
            </div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            {{ isset($student) ? 'Edit' : 'Create' }} Student
                        </h4>
                    </div>
                    <div class="card-body py-4">
                        <form method="POST"
                            action="{{ isset($student) ? route('students.update', ['student' => $student['id']]) : route('students.store') }}">
                            @csrf

                            @if (isset($student))
                                @method('PUT')
                            @endif

                            <div class="form-group row mb-4">
                                <label for="user_id" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    User Account
                                </label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control" name="user_id" id="user_id">
                                        <option value="">-- Pilih User --</option>
                                        @foreach ($data['users'] as $user)
                                            <option value="{{ $user->id }}"
                                                {{ isset($user) && $user['user_id'] == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="nis"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIS</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="nis" id="nis"
                                        value="{{ isset($student) ? $student['nis'] : '' }}" required>
                                    @error('nis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="name"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ isset($student) ? $student['name'] : '' }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="class_name"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Class</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="class_name" id="class_name"
                                        value="{{ isset($student) ? $student['class_name'] : '' }}" required>
                                    @error('class_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="date_of_birth" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Birth Date
                                </label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ isset($student) ? $student['date_of_birth'] : '' }}" required>
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="address" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Address
                                </label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="address" id="address"
                                        value="{{ isset($student) ? $student['address'] : '' }}" required>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="parent_name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Parent Name
                                </label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="parent_name" id="parent_name"
                                        value="{{ isset($student) ? $student['parent_name'] : '' }}" required>
                                    @error('parent_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- JUSTIFY END -->
                            <div class="form-group row mb-4">
                                <label for="justify" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($student) ? 'Update' : 'Create' }}
                                    </button>
                                    <a href="{{ route('students.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
