@extends('layouts.app')

@section('content')
    <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
            <div class="breadcrumb-item">Users</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List User</h4>
                        <div class="card-header-form d-flex">
                            <a href="{{ route('users.create') }}" class="btn btn-primary">ADD</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th style="width: 12%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['users'] as $user)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>
                                                {{ $user->username }}
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    {{ ucwords($user->role) }}
                                                </span>
                                            </td>
                                            <td style="width: 12%">
                                                <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                                    class="btn btn-warning btn-sm btn-icon mb-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm btn-icon mb-2 deleteModal"
                                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('.deleteModal').click(function() {
                var id = $(this).data('id');

                var name = $(this).data('name');
                swal({
                        title: "Are you sure?",
                        text: "Once deleted you will not be able to recover data " + name + "!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $('#delete-form-' + id).submit();
                        }
                    });
            });
        });
    </script>
@endsection
