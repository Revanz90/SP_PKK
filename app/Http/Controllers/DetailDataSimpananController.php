<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\SavingFile;

class DetailDataSimpananController extends Controller
{
    public function index($id)
    {
        $data = Saving::find($id);
        $file = SavingFile::where('id_savings', $data->id)->first();
        return view('layouts.detail_datasimpanan', ['data' => $data, 'file' => $file]);
    }
}
