<?php

namespace App\Http\Controllers;

use App\Models\DataSimpanan;
use App\Models\FileDataSimpanan;

class DetailDataSimpananController extends Controller
{
    public function index($id)
    {
        $data = DataSimpanan::find($id);
        $file = FileDataSimpanan::where('id_suratmasuk', $data->id)->first();
        return view('layouts.detail_suratmasuk', ['data' => $data, 'file' => $file]);
    }
}
