@extends('layouts.app')

@section('content')
    <div class="section-header">
        <h1>Tabungan Siswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
            <div class="breadcrumb-item">Tabungan Siswa</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Saving Account</h4>
                        <div class="card-header-form d-flex">
                            <a href="{{ route('saving-account.create') }}" class="btn btn-primary">ADD</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Nomer Akun</th>
                                        <th>Saldo</th>
                                        <th style="width: 12%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['saving_accounts'] as $savingaccount)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $savingaccount['student']['name'] }}
                                            </td>
                                            <td>
                                                {{ $savingaccount['account_number'] }}
                                            </td>
                                            <td>
                                                <span class="currency">
                                                    {{ 'Rp' . number_format($savingaccount['balance'], 2, ',', '.') }}
                                                </span>
                                            </td>
                                            <td style="width: 12%">
                                                <a href="{{ route('saving-account.show', ['saving_account' => $savingaccount->id]) }}"
                                                    class="btn btn-info btn-sm btn-icon mb-2">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('saving-account.edit', ['saving_account' => $savingaccount->id]) }}"
                                                    class="btn btn-warning btn-sm btn-icon mb-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm btn-icon mb-2 deleteModal"
                                                    data-id="{{ $savingaccount->id }}"
                                                    data-name="{{ $savingaccount->name }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $savingaccount->id }}"
                                                    action="{{ route('saving-account.destroy', $savingaccount->id) }}"
                                                    method="POST" style="display: none;">
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
