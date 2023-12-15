<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Installment;
use App\Models\InstallmentFile;
use Carbon\Carbon;
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

    public function store_installment(Request $request, $id)
    {
        try {
            $credit = Credit::find($id);
            $installment = new Installment();
            $installmentfile = new InstallmentFile();

            // Validasi yang wajib diinputkan pada request payloads
            $validated = $request->validate([
                'nominal_angsuran' => 'required',
                'tanggal_transfer_angsuran' => 'required',
                'keterangan_angsuran' => 'required',
                'upload_bukti_angsuran' => 'required',
            ]);

            $currentDate = Carbon::parse($request->input('tanggal_transfer_angsuran'));

            if ($currentDate->greaterThan($credit->due_date)) {
                $installment->nominal_angsuran = $request->input('nominal_angsuran');
                $installment->keterangan = $request->input('keterangan_angsuran');
                $installment->tanggal_transfer = $request->input('tanggal_transfer_angsuran');
                $installment->author_id = Auth::id();
                $installment->author_name = Auth::user()->name;
                $installment->credit_id = $id;
                $installment->save();

                // Fungsi untuk mengambil tanggal
                $toDate = Carbon::parse($credit->due_date);
                $fromDate = Carbon::parse($currentDate);

                // Fungsi untuk menghitung denda
                $countdayslate = $toDate->diffInDays($fromDate);
                $denda = $credit->penalty * $countdayslate;
                $hitung_denda = $request->input('nominal_angsuran') - $denda;
                // Fungsi untuk menyimpan denda
                $credit->total_terbayar = $credit->total_terbayar + $hitung_denda;
                $credit->save();

                // Melakukan pengecekan jika inputan memiliki File
                if ($request->hasFile('upload_bukti_angsuran')) {
                    $fileName = $request->upload_bukti_angsuran->getClientOriginalName();

                    // Menyimpan data pada storage local
                    Storage::putFileAs('public/files', $request->upload_bukti_angsuran, $fileName);
                    // Menyimpan File pada database File Surat Masuk
                    $installmentfile->files = $fileName;
                    $installmentfile->id_installments = $installment->id;
                    $installmentfile->save();
                }

            } else {
                $installment->nominal_angsuran = $request->input('nominal_angsuran');
                $installment->tanggal_transfer = $request->input('tanggal_transfer_angsuran');
                $installment->keterangan = $request->input('keterangan_angsuran');
                $installment->author_id = Auth::id();
                $installment->author_name = Auth::user()->name;
                $installment->credit_id = $id;
                $installment->save();

                $hutang_terbayar = $credit->total_terbayar + $installment->nominal_pinjaman = $request->input('nominal_angsuran');
                $credit->total_terbayar = $hutang_terbayar;
                $credit->save();

                // Melakukan pengecekan jika inputan memiliki File
                if ($request->hasFile('upload_bukti_angsuran')) {
                    $fileName = $request->upload_bukti_angsuran->getClientOriginalName();

                    // Menyimpan data pada storage local
                    Storage::putFileAs('public/files', $request->upload_bukti_angsuran, $fileName);
                    // Menyimpan File pada database File Data Pinjaman
                    $installmentfile->files = $fileName;
                    $installmentfile->id_installments = $installment->id;
                    $installmentfile->save();
                }
            }

            return redirect()->back()->with('success', 'Berhasil menambahkan Angsuran');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Gagal menambahkan Angsuran');
        }
    }

    public function updatedataangsuran($id)
    {
        $data = Installment::find($id);
        $data->status = 'disimpan';
        $data->save();
    }
}
