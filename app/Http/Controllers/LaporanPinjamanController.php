<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;

class LaporanPinjamanController extends Controller
{
    public function index(Request $request)
    {
        // $savings = Saving::all()->sortByDesc('created_at');
        $querySavingMonth = Credit::query();
        $month = $request->month_filter;
        $year = $request->year_filter;

        switch ($month) {
            case 'januari':
                $querySavingMonth->whereMonth('created_at', '1');
                break;
            case 'februari':
                $querySavingMonth->whereMonth('created_at', '2');
                break;
            case 'maret':
                $querySavingMonth->whereMonth('created_at', '3');
                break;
            case 'april':
                $querySavingMonth->whereMonth('created_at', '4');
                break;
            case 'mei':
                $querySavingMonth->whereMonth('created_at', '5');
                break;
            case 'juni':
                $querySavingMonth->whereMonth('created_at', '6');
                break;
            case 'juli':
                $querySavingMonth->whereMonth('created_at', '7');
                break;
            case 'agustus':
                $querySavingMonth->whereMonth('created_at', '8');
                break;
            case 'september':
                $querySavingMonth->whereMonth('created_at', '9');
                break;
            case 'oktober':
                $querySavingMonth->whereMonth('created_at', '10');
                break;
            case 'november':
                $querySavingMonth->whereMonth('created_at', '11');
                break;
            case 'desember':
                $querySavingMonth->whereMonth('created_at', '12');
                break;
        }

        switch ($year) {
            case '2023':
                $querySavingMonth->whereYear('created_at', '2023');
                break;
            case '2024':
                $querySavingMonth->whereYear('created_at', '2024');
                break;

        }

        $credits = $querySavingMonth->get();

        return view('layouts.laporan_pinjaman', compact('credits'));
    }
}
