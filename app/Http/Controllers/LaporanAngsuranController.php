<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use Illuminate\Http\Request;

class LaporanAngsuranController extends Controller
{
    public function index(Request $request)
    {
        // $savings = Saving::all()->sortByDesc('tanggal_transfer');
        $querySavingMonth = Angsuran::query();
        $month = $request->month_filter;
        $year = $request->year_filter;

        switch ($month) {
            case 'januari':
                $querySavingMonth->whereMonth('tanggal_transfer', '1');
                break;
            case 'februari':
                $querySavingMonth->whereMonth('tanggal_transfer', '2');
                break;
            case 'maret':
                $querySavingMonth->whereMonth('tanggal_transfer', '3');
                break;
            case 'april':
                $querySavingMonth->whereMonth('tanggal_transfer', '4');
                break;
            case 'mei':
                $querySavingMonth->whereMonth('tanggal_transfer', '5');
                break;
            case 'juni':
                $querySavingMonth->whereMonth('tanggal_transfer', '6');
                break;
            case 'juli':
                $querySavingMonth->whereMonth('tanggal_transfer', '7');
                break;
            case 'agustus':
                $querySavingMonth->whereMonth('tanggal_transfer', '8');
                break;
            case 'september':
                $querySavingMonth->whereMonth('tanggal_transfer', '9');
                break;
            case 'oktober':
                $querySavingMonth->whereMonth('tanggal_transfer', '10');
                break;
            case 'november':
                $querySavingMonth->whereMonth('tanggal_transfer', '11');
                break;
            case 'desember':
                $querySavingMonth->whereMonth('tanggal_transfer', '12');
                break;
        }

        switch ($year) {
            case '2023':
                $querySavingMonth->whereYear('tanggal_transfer', '2023');
                break;
            case '2024':
                $querySavingMonth->whereYear('tanggal_transfer', '2024');
                break;

        }

        $installments = $querySavingMonth->get();

        return view('layouts.laporan_angsuran', compact('installments'));
    }
}
