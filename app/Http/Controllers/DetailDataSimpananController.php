<?php

namespace App\Http\Controllers;

use App\Models\SavingFile;
use App\Models\Simpanan;

class DetailDataSimpananController extends Controller
{
    public function index($id)
    {
        $data = Simpanan::find($id);
        $file = SavingFile::where('id_savings', $data->id)->first();
        return view('layouts.detail_datasimpanan', ['data' => $data, 'file' => $file]);
    }
}
