<?php

namespace App\Http\Controllers;

use App\Models\CreditFile;
use App\Models\Pinjamans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class CreditController extends Controller
{
    use HasRoles;

    public function index()
    {
        $credit = Pinjamans::all()->sortByDesc('created_at');
        return view('layouts.data_pinjaman', ['datas' => $credit]);
    }

    public function store(Request $request)
    {
        try {
            $credit = new Pinjamans();
            $fileCredit = new CreditFile();

            // Validasi yang wajib diinputkan pada request payloads
            $validated = $request->validate([
                'nominal' => 'required',
                'tanggal_transaksi' => 'required',
                'keterangan' => 'required',
                'upload_bukti' => 'required',
            ]);

            $credit->nominal_pinjaman = $request->input('nominal');
            $credit->tanggal_pinjaman = $request->input('tanggal_transaksi');
            $credit->keterangan = $request->input('keterangan');
            $credit->author_id = Auth::id();
            $credit->author_name = Auth::user()->name;
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
            // dd($th);
            return redirect()->back()->with('error', 'Gagal menambahkan Pinjaman');
        }
    }

}
