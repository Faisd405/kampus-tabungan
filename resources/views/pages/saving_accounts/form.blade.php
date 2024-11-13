@extends('layouts.app')

@section('content')
    <div class="section-header">
        <h1>Saving Account</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
            <div class="breadcrumb-item"><a href="{{ route('saving-account.index') }}">Saving Account</a></div>
            <div class="breadcrumb-item">
                {{ isset($savingAccount) ? 'Edit' : 'Create' }}
            </div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            {{ isset($savingAccount) ? 'Edit' : 'Create' }} User
                        </h4>
                    </div>
                    <div class="card-body py-4">
                        <form method="POST"
                            action="{{ isset($savingAccount) ? route('saving-account.update', ['savingAccount' => $savingAccount['id']]) : route('saving-account.store') }}">
                            @csrf

                            @if (isset($savingAccount))
                                @method('PUT')
                            @endif

                            <div class="form-group row mb-4">
                                <label for="account_number" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Siswa
                                </label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control" name="student_id" id="student_id">
                                        <option value="">-- Pilih Siswa --</option>
                                        @foreach ($data['students'] as $student)
                                            <option value="{{ $student->id }}"
                                                {{ isset($student) && $student['student_id'] == $student->id ? 'selected' : '' }}>
                                                {{ $student->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="account_number" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Saving Account
                                </label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="account_number" id="account_number"
                                        value="{{ isset($savingAccount) ? $savingAccount['account_number'] : '' }}"
                                        required>

                                    @error('account_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="account_number" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Balance
                                </label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="number" class="form-control" name="balance" id="account_number"
                                        value="{{ isset($savingAccount) ? $savingAccount['balance'] : '' }}" required>

                                    @error('balance')
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
                                        {{ isset($savingAccount) ? 'Update' : 'Create' }}
                                    </button>
                                    <a href="{{ route('saving-account.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
