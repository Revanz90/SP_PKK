<?php

namespace App\Http\Controllers;

use App\Models\Saving;

class DashboardController extends Controller
{
    public function hitungsurat()
    {
        $saving = Saving::count();
        $credit = Saving::where('status', 'diterima')->get()->count();
        $instalment = Saving::where('status', 'ditolak')->get()->count();

        return view('dashboard', ['countsaving' => $saving, 'countcredit' => $credit, 'countinstalment' => $instalment]);
    }
}
