<?php

namespace App\Http\Controllers;

use App\Models\DataAngsuran;
use App\Models\FileDataAngsuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DataAngsuranController extends Controller
{
    public function index()
    {
        $dataAngsuran = DataAngsuran::all()->sortByDesc('created_at');
        return view('layouts.data_angsuran', ['datas' => $dataAngsuran]);
    }

    public function store(Request $request)
    {
        try {
            $dataangsuran = new DataAngsuran();
            $filedataangsuran = new FileDataAngsuran();

            // Validasi yang wajib diinputkan pada request payloads
            $validated = $request->validate([
                'dari' => 'required',
                'no_surat' => 'required',
                'perihal' => 'required',
                'keterangan' => 'required',
                'Input_SuratMasuk' => 'required',
            ]);

            $dataangsuran->dari = $request->input('dari');
            $dataangsuran->no_surat = $request->input('no_surat');
            $dataangsuran->perihal = $request->input('perihal');
            $dataangsuran->keterangan = $request->input('keterangan');
            $dataangsuran->author_id = Auth::id();
            $dataangsuran->save();

            // Melakukan pengecekan jika inputan memiliki File
            if ($request->hasFile('Input_DataAngsuran')) {
                $fileName = $request->Input_DataAngsuran->getClientOriginalName();

                // Menyimpan data pada storage local
                Storage::putFileAs('public/files', $request->Input_DataAngsuran, $fileName);
                // Menyimpan File pada database File Surat Masuk
                $filedataangsuran->files = $fileName;
                $filedataangsuran->id_dataangsuran = $dataangsuran->id;
                $filedataangsuran->save();
            }

            return redirect()->back()->with('success', 'Berhasil menambahkan Surat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menambahkan Surat');
        }
    }

    public function updatedatasimpanan($id)
    {
        $data = DataAngsuran::find($id);
        $data->status = 'disimpan';
        $data->ditakahkan_at = now();
        $data->save();

        return redirect()->route('ditakahkan')->with('success', 'Berhasil DItakahkan');
    }
}
