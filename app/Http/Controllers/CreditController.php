<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\CreditFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class CreditController extends Controller
{
    use HasRoles;

    public function index()
    {
        $credit = Credit::all()->sortByDesc('created_at');
        return view('layouts.data_pinjaman', ['datas' => $credit]);
    }

    public function store(Request $request)
    {
        try {
            $credit = new Credit();
            $fileCredit = new CreditFile();

            // Validasi yang wajib diinputkan pada request payloads
            $validated = $request->validate([
                'nominal' => 'required',
                'tanggal_transaksi' => 'required',
                'keterangan' => 'required',
                'upload_bukti' => 'required',
            ]);

            $credit->nominal_uang = $request->input('nominal');
            $credit->tanggal_transfer = $request->input('tanggal_transaksi');
            $credit->keterangan = $request->input('keterangan');
            $credit->author_id = Auth::id();
            $credit->author_name = Auth::user()->name;
            $credit->loan_interest = 0;
            $credit->penalty = 0;
            $credit->save();

            // Melakukan pengecekan jika inputan memiliki File
            if ($request->hasFile('upload_bukti')) {
                $fileName = $request->upload_bukti->getClientOriginalName();

                // Menyimpan data pada storage local
                Storage::putFileAs('public/files', $request->upload_bukti, $fileName);
                // Menyimpan File pada database File Data Pinjaman
                $fileCredit->files = $fileName;
                $fileCredit->id_credits = $credit->id;
                $fileCredit->save();
            }

            return redirect()->back()->with('success', 'Berhasil menambahkan Pinjaman');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Gagal menambahkan Pinjaman');
        }
    }

    public function updatestatuscredit(Request $request, $id)
    {
        $buttonValue = $request->input('c');
        // dd($buttonValue);

        if ($buttonValue == 'diterima') {
            $credit = Credit::find($id);
            $credit->status_credit = 'diterima';
            $credit->status_ketua = 'diterima';
            $credit->loan_interest = 0.05;
            $credit->penalty = 5000;
            $credit->due_date = 30;
            $credit->save();

            return redirect()->back()->with('success', 'Pinjaman Ini Diterima');
        }

        if ($buttonValue == 'ditolak') {
            $credit = Credit::find($id);
            $credit->status_credit = 'ditolak';
            $credit->status_ketua = 'ditolak';
            $credit->loan_interest = 0;
            $credit->penalty = 0;
            $credit->save();

            return redirect()->back()->with('error', 'Pinjaman ini Ditolak');
        }

    }
}
