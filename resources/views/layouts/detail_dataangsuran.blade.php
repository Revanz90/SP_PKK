@extends('main')

@section('title', 'Detail Data Angsuran')
@section('title2', 'Detail Data Angsuran')
@section('judul', 'Detail Data Angsuran')

@section('content')
    <div id="xtest" style="font-size: 14px"></div>
    <div class="callout callout-warning">
        <i class="fas fa-info-circle"></i>
        Halaman untuk melihat detail data Angsuran
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title font-weight-bold">DATA ANGSURAN</h4>
            <div class="card-tools">
                <input type="hidden" name="statusM" id="statusMid[2]" value="2">
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
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Nominal Angsuran</label>
                    <div class="col-sm-10">
                        <input type="text" name="" class="form-control" value="{{ $data->nominal_angsuran }}"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Tanggal Angsuran</label>
                    <div class="col-sm-10">
                        <input type="text" name="" class="form-control" value="{{ $data->tanggal_transfer }}"
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
                    <label for="" class="col-sm-2 col-form-label font-weight-normal">Bukti Angsuran File</label>
                    <div class="card-footer bg-white col-sm-10">
                        <embed type="application/pdf" src="{{ url('storage/files/' . $file->files) }}" id="pdf-embed"
                            frameborder="0" width="100%" height="780">
                    </div>
                </div>
            </form>
        </div>
        {{-- @endforeach --}}
    </div>
@endsection
