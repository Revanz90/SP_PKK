<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Installment;
use App\Models\Saving;

class DashboardController extends Controller
{
    public function hitungsurat()
    {
        $saving = Saving::count();
        $credit = Credit::count();
        $installment = Installment::count();

        // $credit = Credit::where('status_credit', 'diterima')->get()->count();

        return view('dashboard', ['countsaving' => $saving, 'countcredit' => $credit, 'countinstalment' => $installment]);
    }
}
