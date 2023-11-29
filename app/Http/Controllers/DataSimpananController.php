<?php

namespace App\Http\Controllers;

use App\Models\DataSimpanan;
use App\Models\FileDataSimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DataSimpananController extends Controller
{
    public function index()
    {
        $dataSimpanan = DataSimpanan::all()->sortByDesc('created_at');
        return view('layouts.data_simpanan', ['datas' => $dataSimpanan]);
    }

    public function store(Request $request)
    {
        try {
            $datasimpanan = new DataSimpanan();
            $filedatasimpanan = new FileDataSimpanan();

            // Validasi yang wajib diinputkan pada request payloads
            $validated = $request->validate([
                'dari' => 'required',
                'no_surat' => 'required',
                'perihal' => 'required',
                'keterangan' => 'required',
                'Input_SuratMasuk' => 'required',
            ]);

            $datasimpanan->dari = $request->input('dari');
            $datasimpanan->no_surat = $request->input('no_surat');
            $datasimpanan->perihal = $request->input('perihal');
            $datasimpanan->keterangan = $request->input('keterangan');
            $datasimpanan->author_id = Auth::id();
            $datasimpanan->save();

            // Melakukan pengecekan jika inputan memiliki File
            if ($request->hasFile('Input_DataSimpanan')) {
                $fileName = $request->Input_DataSimpanan->getClientOriginalName();

                // Menyimpan data pada storage local
                Storage::putFileAs('public/files', $request->Input_DataSimpanan, $fileName);
                // Menyimpan File pada database File Surat Masuk
                $filedatasimpanan->files = $fileName;
                $filedatasimpanan->id_datasimpanan = $datasimpanan->id;
                $filedatasimpanan->save();
            }

            return redirect()->back()->with('success', 'Berhasil menambahkan Surat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menambahkan Surat');
        }
    }

    public function updatedatasimpanan($id)
    {
        $data = DataSimpanan::find($id);
        $data->status = 'disimpan';
        $data->ditakahkan_at = now();
        $data->save();

        return redirect()->route('ditakahkan')->with('success', 'Berhasil DItakahkan');
    }
}
