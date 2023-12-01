<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\InstallmentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InstallmentController extends Controller
{
    public function index()
    {
        $installment = Installment::all()->sortByDesc('created_at');
        return view('layouts.data_angsuran', ['datas' => $installment]);
    }

    public function store(Request $request)
    {
        try {
            $installment = new Installment();
            $installmentfile = new InstallmentFile();

            // Validasi yang wajib diinputkan pada request payloads
            $validated = $request->validate([
                'nominal' => 'required',
                'tanggal_transaksi' => 'required',
                'keterangan' => 'required',
                'upload_bukti' => 'required',
            ]);

            $installment->nominal_uang = $request->input('nominal');
            $installment->created_at = $request->input('tanggal_transaksi');
            $installment->keterangan = $request->input('keterangan');
            $installment->author_id = Auth::id();
            $installment->author_name = Auth::user()->name;
            $installment->save();

            // Melakukan pengecekan jika inputan memiliki File
            if ($request->hasFile('upload_bukti')) {
                $fileName = $request->upload_bukti->getClientOriginalName();

                // Menyimpan data pada storage local
                Storage::putFileAs('public/files', $request->upload_bukti, $fileName);
                // Menyimpan File pada database File Surat Masuk
                $installmentfile->files = $fileName;
                $installmentfile->id_installments = $installment->id;
                $installmentfile->save();
            }

            return redirect()->back()->with('success', 'Berhasil menambahkan Surat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menambahkan Surat');
        }
    }

    public function updatedatasimpanan($id)
    {
        $data = Installment::find($id);
        $data->status = 'disimpan';
        // $data->ditakahkan_at = now();
        $data->save();

        // return redirect()->route('ditakahkan')->with('success', 'Berhasil DItakahkan');
    }
}
