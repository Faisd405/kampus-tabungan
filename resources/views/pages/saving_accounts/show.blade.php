@extends('layouts.app')


@section('content')
    <div class="section-header">
        <h1>Transactions</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
            <div class="breadcrumb-item"><a href="/website/saving-accounts/index.php">Tabungan</a></div>
            <div class="breadcrumb-item">Transactions</div>
        </div>
    </div>
    <div class="section-body">
        <!-- Detail Row -->
        <div class="row">
            <div class="col-lg-8 col-md-6  col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Tabungan</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td style="width: 20%;"><b>Nomor Akun</b></td>
                                <td style="width: 8%;">:</td>
                                <td>{{ $savingAccount['account_number'] }}</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><b>Nama Siswa</b></td>
                                <td style="width: 8%;">:</td>
                                <td>{{ $savingAccount['student']['name'] }}</td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6  col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Saldo</h4>
                        </div>
                        <div class="card-body">
                            {{ 'Rp' . number_format($savingAccount['balance'], 2, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Transactions</h4>
                        <div class="card-header-form d-flex">
                            <form class="mr-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari Nama" name="search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <button type="button" class="btn btn-primary" id="addModal">
                                Tambah Transaksi
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Transaksi</th>
                                        <th>Nominal</th>
                                        <th>Nama Staff</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($savingAccount['transactions'] as $value)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $value['date'] }}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $value['type'] == 'deposit' ? 'success' : 'danger' }}">
                                                    {{ $value['type'] }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ 'Rp' . number_format($value['amount'], 2, ',', '.') }}
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    {{ $value['staff']['name'] }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning btn-sm btn-icon mb-2 editModal"
                                                    data-id="{{ $value['id'] }}" data-date="{{ $value['date'] }}"
                                                    data-type="{{ $value['type'] }}" data-amount="{{ $value['amount'] }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm btn-icon mb-2 deleteModal"
                                                    data-id="{{ $value['id'] }}" data-name="{{ $value['date'] }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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

    @push('modal')
        <div class="modal fade" tabindex="-1" role="dialog" id="formModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Tambah Transaksi
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" method="POST">
                        @csrf

                        <div class="modal-body">
                            <input type="text" name="id" value="" hidden>
                            <input type="text" name="account_id" value="{{ $savingAccount['id'] }}" hidden>
                            <div class="form-group">
                                <label for="date">Transaction Date</label>
                                <input type="datetime-local" step="any" class="form-control" name="date" id="date"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="type">Transaction Type</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="deposit">Deposit</option>
                                    <option value="withdrawal">Withdraw</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            IDR
                                        </div>
                                    </div>
                                    <input type="text" name="amount" class="form-control currency" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush

    @push('page-script')
        <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
        <script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
        <script>
            let formType = 'create';
            let selectedId = null;
            let savingAccount = '{{ $savingAccount['id'] }}';

            document.addEventListener("DOMContentLoaded", function() {

                var cleave = new Cleave('.currency', {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });

                $('.editModal').on('click', function() {
                    var id = $(this).data('id');
                    var date = $(this).data('date');
                    var type = $(this).data('type');
                    var amount = $(this).data('amount');

                    formType = 'edit';
                    selectedId = id;

                    $('#formModal').modal('show');

                    $('#formModal').find('[name="id"]').val(id);
                    $('#formModal').find('[name="date"]').val(date.replace(' ', 'T'));
                    $('#formModal').find('[name="type"]').val(type);
                    $('#formModal').find('[name="amount"]').val(amount);

                    $('#formModal').find('.modal-title').text('Edit Transaksi');
                });

                $('#addModal').on('click', function() {
                    formType = 'create';
                    selectedId = null;

                    $('#formModal').modal('show');
                    $('#formModal').find('[name="date"]').val('{{ date('Y-m-d\TH:i') }}');
                    $('#formModal').find('[name="type"]').val('deposit');
                    $('#formModal').find('[name="amount"]').val('');

                    $('#formModal').find('.modal-title').text('Tambah Transaksi');
                });

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
                                axios.delete('/saving-account/' + savingAccount + '/transaction/' + id)
                                    .then(function(response) {
                                        location.reload();
                                    })
                                    .catch(function(error) {
                                        console.log(error);
                                    });
                            }
                        });
                });

                // form submit
                $('#formModal form').on('submit', function(e) {
                    e.preventDefault();

                    var data = $(this).serializeArray();
                    var url = '/saving-account/' + savingAccount + '/transaction';
                    var method = 'POST';

                    if (formType == 'edit') {
                        url = '/saving-account/' + savingAccount + '/transaction/' + selectedId;
                        method = 'PUT';
                    }

                    data = data.reduce(function(acc, item) {
                        acc[item.name] = item.value;
                        return acc;
                    }, {});

                    // amount string to number
                    data.amount = data.amount.replace(/,/g, '.');

                    axios({
                            method: method,
                            url: url,
                            data: data
                        })
                        .then(function(response) {
                            location.reload();
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                });
            });
        </script>
    @endpush
@endsection
