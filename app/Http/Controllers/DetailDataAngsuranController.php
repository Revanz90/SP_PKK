<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\InstallmentFile;

class DetailDataAngsuranController extends Controller
{
    public function index($id)
    {
        $data = Installment::find($id);
        $file = InstallmentFile::where('id_installments', $data->id)->first();
        return view('layouts.detail_dataangsuran', ['data' => $data, 'file' => $file]);
    }
}
