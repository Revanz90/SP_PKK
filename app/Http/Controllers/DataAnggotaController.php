<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class DataAnggotaController extends Controller
{
    public function index()
    {
        $member = Anggota::all()->sortByDesc('');
        return view('layouts.data_anggota', ['datas' => $member]);
    }

    public function store(Request $request)
    {
        try {
            $member = new Anggota();

            // Validasi yang wajib diinputkan pada request payloads
            $validated = $request->validate([
                'nama_anggota' => 'required',
                'id_anggota' => 'required',
                'alamat_anggota' => 'required',
                'jenis_kelamin' => 'required',
            ]);

            $member->nama_anggota = $request->input('nama_anggota');
            $member->id_anggota = $request->input('id_anggota');
            $member->alamat_anggota = $request->input('alamat_anggota');
            $member->jenis_kelamin = $request->input('jenis_kelamin');
            $member->save();
            // dd($member);

            return redirect()->back()->with('success', 'Berhasil menambahkan anggota');

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Gagal menambahkan anggota');
        }
    }
}
