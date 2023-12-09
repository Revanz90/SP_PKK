<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Carbon\Carbon;

class MonthlyReportController extends Controller
{
    public function monthly()
    {
        $currentYear = Carbon::now()->year;
        $saving = Saving::all()->sortByDesc('created_at');

        return view('layouts.monthly_report', ['datas' => $saving]);
    }
}
