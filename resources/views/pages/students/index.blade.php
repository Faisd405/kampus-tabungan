@extends('layouts.app')

@section('content')
    <div class="section-header">
        <h1>Students</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
            <div class="breadcrumb-item">Students</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Student</h4>
                        <div class="card-header-form d-flex">
                            <a href="{{ route('students.create') }}" class="btn btn-primary">ADD</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pengguna</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Nama Orangtua</th>
                                        <th>Kelas</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th style="width: 12%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['students'] as $student)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $student->user->name ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $student->nis }}
                                            </td>
                                            <td>
                                                {{ $student->name }}
                                            </td>
                                            <td>
                                                {{ $student->parent_name }}
                                            </td>
                                            <td>
                                                {{ $student->class_name }}
                                            </td>
                                            <td>
                                                {{ $student->date_of_birth }}
                                            </td>
                                            <td>
                                                {{ $student->address }}
                                            </td>
                                            <td style="width: 12%">
                                                <a href="{{ route('students.edit', ['student' => $student->id]) }}"
                                                    class="btn btn-warning btn-sm btn-icon mb-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm btn-icon mb-2 deleteModal"
                                                    data-id="{{ $student->id }}" data-name="{{ $student->name }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $student->id }}"
                                                    action="{{ route('students.destroy', $student->id) }}" method="POST"
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
