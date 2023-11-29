<?php

namespace App\Http\Controllers;

use App\Models\DataAngsuran;
use App\Models\FileDataPinjaman;

class DetailDataAngsuranController extends Controller
{
    public function index($id)
    {
        $data = DataAngsuran::find($id);
        $file = FileDataPinjaman::where('id_suratmasuk', $data->id)->first();
        return view('layouts.detail_suratmasuk', ['data' => $data, 'file' => $file]);
    }
}
