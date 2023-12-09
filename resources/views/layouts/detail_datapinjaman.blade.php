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
            <div>s
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
@endsection
