@extends('layouts.app')

@section('content')
    <div class="section-header">
        <h1>List Laporan Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Laporan</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-4">
                            <form>
                                <div class="row">
                                    <div class="form-group col-4 mr-2 mb-2">
                                        <input type="text" class="form-control" placeholder="Cari Nomer Akun"
                                            name="search" value="{{ request()->get('search') }}">
                                    </div>
                                    <div class="form-group col-4 mr-2 mb-2">
                                        <select class="form-control" name="type" id="type">
                                            <option value="">Pilih Jenis Transaksi</option>
                                            <option value="deposit"
                                                {{ request()->get('type') == 'deposit' ? 'selected' : '' }}>
                                                Deposit
                                            </option>
                                            <option value="withdraw"
                                                {{ request()->get('type') == 'withdraw' ? 'selected' : '' }}>
                                                Withdraw
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-4 mr-2 mb-2">
                                        <input type="start_date" class="form-control" placeholder="Cari Tanggal" name="date"
                                            value="{{ request()->get('start_date') }}">
                                    </div>
                                    <div class="form-group col-4 mr-2 mb-2">
                                        <input type="end_date" class="form-control" placeholder="Cari Tanggal" name="date"
                                            value="{{ request()->get('end_date') }}">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        Search
                                    </button>
                                    <a href="#" type="button" class="btn btn-danger ml-2">
                                        Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomer Akun</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Transaksi</th>
                                        <th>Nominal</th>
                                        <th>Staff</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $transaction['savingAccount']['account_number'] }}
                                            </td>
                                            <td>
                                                {{ $transaction['date'] }}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $transaction['type'] == 'deposit' ? 'success' : 'danger' }}">
                                                    {{ $transaction['type'] }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="currency">
                                                    {{ 'Rp' . number_format($transaction['amount'], 2, ',', '.') }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $transaction['staff']['name'] }}
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
@endsection
