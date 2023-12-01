<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\CreditFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreditController extends Controller
{
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
            $credit->save();

            // Melakukan pengecekan jika inputan memiliki File
            if ($request->hasFile('upload_bukti')) {
                $fileName = $request->upload_bukti->getClientOriginalName();

                // Menyimpan data pada storage local
                Storage::putFileAs('public/files', $request->upload_bukti, $fileName);
                // Menyimpan File pada database File Surat Masuk
                $fileCredit->files = $fileName;
                $fileCredit->id_credits = $credit->id;
                $fileCredit->save();
            }

            return redirect()->back()->with('success', 'Berhasil menambahkan Simpanan');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Gagal menambahkan Simpanan');
        }
    }

    public function updatedatasimpanan($id)
    {
        $data = Credit::find($id);
        $data->status = 'disimpan';
        // $data->ditakahkan_at = now();
        $data->save();

        // return redirect()->route('ditakahkan')->with('success', 'Berhasil Diterima');
    }
}
