<?php

namespace App\Http\Controllers;

use App\Models\DataPinjaman;
use App\Models\FileDataPinjaman;

class DetailDataSimpananController extends Controller
{
    public function index($id)
    {
        $data = DataPinjaman::find($id);
        $file = FileDataPinjaman::where('id_suratmasuk', $data->id)->first();
        return view('layouts.detail_suratmasuk', ['data' => $data, 'file' => $file]);
    }
}
