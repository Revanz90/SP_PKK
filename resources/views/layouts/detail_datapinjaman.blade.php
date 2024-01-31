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
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-default-angsuran">
                            <i class="fas fa-plus"></i>
                            ANGSURAN
                        </button>
                    @endif
                @endhasrole

                @if ($data->status_credit == 'baru')
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal-default-pinjaman">
                        <i class="fas fa-plus"></i>
                        Nota Pencairan Uang
                    </button>
                @endif
            </div>
        </div>

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
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Nominal Pinjaman</label>
                    <div class="col-sm-10">
                        <input type="text" name="" class="form-control" value="{{ $data->nominal_pinjaman }}"
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
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Tanggal pinjaman</label>
                    <div class="col-sm-10">
                        <input type="text" name="" class="form-control" value="{{ $data->tanggal_pinjaman }}"
                            readonly>
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
                        <embed type="application/pdf" src="{{ url('storage/files/' . $file->files) }}" id="pdf-embed"
                            frameborder="0" width="100%" height="780">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal review pinjaman -->
    <div class="modal fade" id="modal-default-pinjaman">
        <div class="modal-dialog" style="max-width: 80%">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nota Pencairan Uang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="content">
                        <div class="card">
                            <!-- Navbar Content -->
                            <div class="card-header ">
                                <h4 class="card-title font-weight-bold">TAMBAH NOTA PENCAIRAN UANG</h4>
                                <div class="card-tools"></div>
                            </div>
                            <!-- /Navbar Content -->
                            <!-- Page Content -->
                            <form action="" enctype="multipart/form-data" method="POST" class="form-horizontal"
                                id="reviewpinjamanform">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="form-group row">
                                                    <label for=""
                                                        class="col-sm-2 col-form-label font-weight-normal">No Nota</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="no_nota" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for=""
                                                        class="col-sm-2 col-form-label font-weight-normal">Keterangan
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="keterangan_review_pinajaman"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="proposal_ProposalTA"
                                                        class="col-sm-2 col-form-label font-weight-normal">Upload Bukti
                                                        Transfer</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" name="upload_bukti_transfer_review"
                                                            class="form-control" required>
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
                    <button type="button" class="btn btn-info" data-dismiss="modal">KEMBALI</button>
                    <div class="btn-savechange-reset">
                        @if ($data->status_ketua == 'baru')
                            @hasrole('admin|ketua')
                                <button type="submit" class="btn btn-danger" value="ditolak" name="c"
                                    form="reviewpinjamanform">
                                    <i class="fas fa-times"></i>
                                    Ditolak
                                </button>
                                <button type="submit" class="btn btn-success" value="diterima" name="c"
                                    form="reviewpinjamanform">
                                    <i class="fas fa-check"></i>
                                    Diterima
                                </button>
                            @endhasrole
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>

    <!-- Modal Angsuran -->
    <div class="modal fade" id="modal-default-angsuran">
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
                            <form action="{{ route('store_dataangsuran', ['id' => $data->id]) }}"
                                enctype="multipart/form-data" method="POST" class="form-horizontal" id="pinjamanform">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="form-group row">
                                                    <label for=""
                                                        class="col-sm-2 col-form-label font-weight-normal">Nominal
                                                        Angsuran</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="nominal_angsuran"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for=""
                                                        class="col-sm-2 col-form-label font-weight-normal">Tanggal
                                                        Transfer</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" name="tanggal_transfer_angsuran"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for=""
                                                        class="col-sm-2 col-form-label font-weight-normal">Keterangan
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="keterangan_angsuran"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="proposal_ProposalTA"
                                                        class="col-sm-2 col-form-label font-weight-normal">Upload Bukti
                                                        Angsuran</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" name="upload_bukti_angsuran"
                                                            class="form-control" required>
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
