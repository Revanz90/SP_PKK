<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;

class LaporanPinjamanController extends Controller
{
    public function index(Request $request)
    {
        // $savings = Saving::all()->sortByDesc('tanggal_pinjaman');
        $querySavingMonth = Credit::query();
        $month = $request->month_filter;
        $year = $request->year_filter;

        switch ($month) {
            case 'januari':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '1');
                break;
            case 'februari':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '2');
                break;
            case 'maret':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '3');
                break;
            case 'april':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '4');
                break;
            case 'mei':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '5');
                break;
            case 'juni':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '6');
                break;
            case 'juli':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '7');
                break;
            case 'agustus':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '8');
                break;
            case 'september':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '9');
                break;
            case 'oktober':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '10');
                break;
            case 'november':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '11');
                break;
            case 'desember':
                $querySavingMonth->whereMonth('tanggal_pinjaman', '12');
                break;
        }

        switch ($year) {
            case '2023':
                $querySavingMonth->whereYear('tanggal_pinjaman', '2023');
                break;
            case '2024':
                $querySavingMonth->whereYear('tanggal_pinjaman', '2024');
                break;

        }

        $credits = $querySavingMonth->get();

        return view('layouts.laporan_pinjaman', compact('credits'));
    }
}
