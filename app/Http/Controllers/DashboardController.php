<?php

namespace App\Http\Controllers;

use App\Models\DataSimpanan;

class DashboardController extends Controller
{
    public function hitungsurat()
    {
        $csuratmasuk = DataSimpanan::count();
        $cditakahkan = DataSimpanan::whereNotNull('ditakahkan_at')->get()->count();
        $csuratditerima = DataSimpanan::where('status', 'diterima')->get()->count();
        $csuratditolak = DataSimpanan::where('status', 'ditolak')->get()->count();

        return view('dashboard', ['countsuratmasuk' => $csuratmasuk, 'countditakahkan' => $cditakahkan, 'countsuratditerima' => $csuratditerima, 'countsuratditolak' => $csuratditolak]);
    }
}
