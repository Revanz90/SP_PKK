<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Angsuran;
use App\Models\Pinjamans;
use App\Models\Simpanan;

class DashboardController extends Controller
{
    public function hitungsurat()
    {
        $anggota = Anggota::count();
        $simpanan = Simpanan::count();
        $pinjaman = Pinjamans::count();
        $angsuran = Angsuran::count();

        // $credit = Credit::where('status_credit', 'diterima')->get()->count();

        return view('dashboard', ['countmember' => $anggota, 'countsaving' => $simpanan, 'countcredit' => $pinjaman, 'countinstalment' => $angsuran]);
    }
}
