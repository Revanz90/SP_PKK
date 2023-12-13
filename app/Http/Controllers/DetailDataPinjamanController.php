<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\CreditFile;

class DetailDataPinjamanController extends Controller
{
    public function index($id)
    {
        $data = Credit::find($id);
        $file = CreditFile::where('id_credits', $data->id)->first();

        $getTotalTerbayar = $data->total_terbayar;
        $getTotalPinjaman = $data->nominal_pinjaman;

        if ($getTotalTerbayar == $getTotalPinjaman) {
            $data->status_credit = 'lunas';
            $data->save();
        }

        return view('layouts.detail_datapinjaman', ['data' => $data, 'file' => $file]);
    }
}
