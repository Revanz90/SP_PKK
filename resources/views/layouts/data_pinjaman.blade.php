@extends('main')

@section('title', 'Pinjaman')
@section('title2', 'Pinjaman')
@section('judul', 'Pinjaman')

@section('page-js-files')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@stop

@section('content')
    <section class="content">
        <div id="xtest" style="font-size: 14px"></div>
        <div class="callout callout-warning">
            <i class="fas fa-info-circle"></i>
            Halaman untuk melihat dan menambah data pinjaman
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="card">
            <!-- Navbar Content -->
            <div class="card-header">
                <h4 class="card-title font-weight-bold">DATA PINJAMAN</h4>
                <div class="card-tools">
                    <input type="hidden" name="xnull" id="statusxid[2]" value="2">
                    <div class="project-actions text-center">
                        <a href="{{ route('laporan_pinjaman') }}" class="btn btn-warning" role="button"
                            data-bs-toggle="button">
                            <i class="fas fa-print"></i>
                            CETAK</a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            <i class="fas fa-plus"></i>
                            TAMBAH
                        </button>
                    </div>
                </div>
            </div>
            <!-- /Navbar Content -->

            <!-- Page Content -->
            <div class="card-body">
                <table id="examplePolos" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Anggota</th>
                            <th>Nama Anggota</th>
                            <th>Nominal Pinjaman</th>
                            <th>Sudah Terbayar</th>
                            <th>Tanggal Pinjaman</th>
                            <th>Keterangan</th>
                            <th>Status Pinjaman</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $index => $data)
                            <tr>
                                <td>{{ $data->author_id }}</td>
                                <td>{{ $data->author_name }}</td>
                                <td>{{ $data->nominal_pinjaman }}</td>
                                <td>{{ $data->total_terbayar }}</td>
                                <td>{{ $data->tanggal_pinjaman }}</td>
                                <td>{{ $data->keterangan }}</td>
                                <td class="text-center d-flex flex-column align-items-stretch" style="gap: 4px">
                                    <div class="btn btn-xs {{ $data->status_credit_masuk }}">
                                        {{ Str::ucfirst($data->status_credit) }}</div>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-xs text-center d-flex flex-column align-items-stretch"
                                        href=" {{ route('detail_datapinjaman', ['id' => $data->id]) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal pinjaman -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog" style="max-width: 80%">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pinjaman</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="content">
                        <div class="card">
                            <!-- Navbar Content -->
                            <div class="card-header ">
                                <h4 class="card-title font-weight-bold">TAMBAH PINJAMAN</h4>
                                <div class="card-tools"></div>
                            </div>
                            <!-- /Navbar Content -->
                            <!-- Page Content -->
                            <form action="" enctype="multipart/form-data" method="POST" class="form-horizontal"
                                id="pinjamanform">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="form-group row">
                                                    <label for=""
                                                        class="col-sm-2 col-form-label font-weight-normal">Nominal
                                                        Pinjaman</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="nominal" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for=""
                                                        class="col-sm-2 col-form-label font-weight-normal">Tanggal
                                                        Pinjaman</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" name="tanggal_transaksi" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for=""
                                                        class="col-sm-2 col-form-label font-weight-normal">Keterangan
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="keterangan" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="proposal_ProposalTA"
                                                        class="col-sm-2 col-form-label font-weight-normal">Upload Syarat
                                                        Pinjaman</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" name="upload_bukti" class="form-control"
                                                            required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- /Page Content -->
                        </div>
                    </section>
                </div>
                <!-- /Main Content -->

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <div class="btn-savechange-reset">
                        <button type="reset" class="btn btn-sm btn-warning" style="margin-right: 5px">Reset</button>
                        <button type="submit" form="pinjamanform" value="Submit"
                            class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>

@endsection
