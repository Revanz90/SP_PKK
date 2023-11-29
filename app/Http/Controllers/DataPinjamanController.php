<?php

namespace App\Http\Controllers;

use App\Models\DataPinjaman;
use App\Models\FileDataPinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DataPinjamanController extends Controller
{
    public function index()
    {
        $dataPinjaman = DataPinjaman::all()->sortByDesc('created_at');
        return view('layouts.data_pinjaman', ['datas' => $dataPinjaman]);
    }

    public function store(Request $request)
    {
        try {
            $datapinjaman = new DataPinjaman();
            $filedatapinjaman = new FileDataPinjaman();

            // Validasi yang wajib diinputkan pada request payloads
            $validated = $request->validate([
                'dari' => 'required',
                'no_surat' => 'required',
                'perihal' => 'required',
                'keterangan' => 'required',
                'Input_SuratMasuk' => 'required',
            ]);

            $datapinjaman->dari = $request->input('dari');
            $datapinjaman->no_surat = $request->input('no_surat');
            $datapinjaman->perihal = $request->input('perihal');
            $datapinjaman->keterangan = $request->input('keterangan');
            $datapinjaman->author_id = Auth::id();
            $datapinjaman->save();

            // Melakukan pengecekan jika inputan memiliki File
            if ($request->hasFile('Input_DataPinjaman')) {
                $fileName = $request->Input_DataPinjaman->getClientOriginalName();

                // Menyimpan data pada storage local
                Storage::putFileAs('public/files', $request->Input_DataPinjaman, $fileName);
                // Menyimpan File pada database File Surat Masuk
                $filedatapinjaman->files = $fileName;
                $filedatapinjaman->id_datapinjaman = $datapinjaman->id;
                $filedatapinjaman->save();
            }

            return redirect()->back()->with('success', 'Berhasil menambahkan Surat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menambahkan Surat');
        }
    }

    public function updatedatapinjaman($id)
    {
        $data = DataPinjaman::find($id);
        $data->status = 'disimpan';
        $data->ditakahkan_at = now();
        $data->save();

        return redirect()->route('ditakahkan')->with('success', 'Berhasil DItakahkan');
    }
}
