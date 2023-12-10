@extends('main')

@section('title', 'Detail Data Pinjaman')
@section('title2', 'Detail Data Pinjaman')
@section('judul', 'Detail Data Pinjaman')

@section('content')
    <div id="xtest" style="font-size: 14px"></div>
    <div class="card">
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
        <div class="d-flex bd-highlight card-header">
            <h4 class="p-2 flex-grow-1 bd-highlight card-title font-weight-bold">DATA PINJAMAN</h4>
            <div>
                @hasrole('admin|ketua|anggota')
                    @if ($data->status_credit == 'aktif')
                        <form method="POST" action="{{ route('storedataangsuran', ['id' => $data->id]) }}">
                            @csrf
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-plus"></i>
                                ANGSURAN
                            </button>
                    @endif
                @endhasrole
                @if ($data->status_ketua == 'baru')
                    @hasrole('admin|ketua')
                        <form method="POST" action="{{ route('creditstatus', ['id' => $data->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-success" value="diterima" name="c">
                                <i class="fas fa-check"></i>
                                Diterima
                            </button>
                            <button type="submit" class="btn btn-danger" value="ditolak" name="c">
                                <i class="fas fa-times"></i>
                                Ditolak
                            </button>
                        </form>
                    @endhasrole
                @endif

            </div>
        </div>
        {{-- @foreach ($datadetailsm as $data) --}}
        <div class="card-body">
            <form action="" class="form-horizontal">

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">ID Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" name="" class="form-control" value="{{ $data->author_id }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Nama Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" name="" class="form-control" value="{{ $data->author_name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Nominal</label>
                    <div class="col-sm-10">
                        <input type="text" name="" class="form-control" value="{{ $data->nominal_uang }}"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Sudah Terbayar</label>
                    <div class="col-sm-10">
                        <input type="text" name="" class="form-control" value="{{ $data->total_terbayar }}"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" name="" class="form-control" value="{{ $data->created_at }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="" class="form-control text-bold" readonly>{{ $data->keterangan }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Status Pinjaman</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="" class="form-control text-bold" readonly>{{ Str::ucfirst($data->status_credit) }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Syarat Pinjaman File</label>
                    <div class="card-footer bg-white col-sm-10">
                        <p><a href="{{ url('storage/files/' . $file->files) }}"
                                class="mailbox-attachment-name"><u>{{ $file->files }}</u></a></p>
                    </div>
                </div>
            </form>
        </div>
        {{-- @endforeach --}}
    </div>

    <!-- Modal pinjaman -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog" style="max-width: 80%">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Angsuran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="content">
                        <div class="card">
                            <!-- Navbar Content -->
                            <div class="card-header ">
                                <h4 class="card-title font-weight-bold">TAMBAH ANGSURAN</h4>
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
                                                        class="col-sm-2 col-form-label font-weight-normal">Nominal</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="nominal" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for=""
                                                        class="col-sm-2 col-form-label font-weight-normal">Tanggal</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" name="tanggal_transaksi"
                                                            class="form-control">
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
