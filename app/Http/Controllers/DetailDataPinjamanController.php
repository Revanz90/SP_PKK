<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\CreditFile;
use App\Models\ReviewCredit;
use App\Models\ReviewCreditFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DetailDataPinjamanController extends Controller
{
    public function index($id)
    {
        $data = Credit::find($id);
        $file = CreditFile::where('id_credits', $data->id)->first();

        $getTotalTerbayar = $data->total_terbayar;
        $getTotalPinjaman = $data->nominal_pinjaman;

        if ($getTotalTerbayar == $getTotalPinjaman) {
            $data->status_credit = 'lunas';
            $data->save();
        }

        return view('layouts.detail_datapinjaman', ['data' => $data, 'file' => $file]);
    }

    public function store_review(Request $request, $id)
    {
        $buttonValue = $request->input('c');

        if ($buttonValue == 'diterima') {
            try {
                $credit = Credit::find($id);
                $reviewcredit = new ReviewCredit();
                $reviewcreditfile = new ReviewCreditFile();

                $validated = $request->validate([
                    'no_nota' => 'required',
                    'keterangan_review_pinajaman' => 'required',
                    'upload_bukti_transfer_review' => 'required',
                ]);

                $credit->status_credit = 'aktif';
                $credit->status_ketua = 'diterima';
                $credit->loan_interest = 0.05;
                $credit->penalty = 5000;
                $credit->nominal_pinjaman = $credit->nominal_pinjaman + ($credit->nominal_pinjaman * $credit->loan_interest);
                $credit->save();

                $reviewcredit->no_nota = $request->input('no_nota');
                $reviewcredit->keterangan = $request->input('keterangan_review_pinajaman');
                $reviewcredit->credit_id = $id;
                $reviewcredit->author_id = Auth::id();
                $reviewcredit->save();

                if ($request->hasFile('upload_bukti_transfer_review')) {
                    $fileName = $request->upload_bukti_transfer_review->getClientOriginalName();

                    // Menyimpan data pada storage local
                    Storage::putFileAs('public/files', $request->upload_bukti_transfer_review, $fileName);
                    // Menyimpan File pada database File Data Pinjaman
                    $reviewcreditfile->files = $fileName;
                    $reviewcreditfile->review_credit_id = $reviewcredit->id;
                    $reviewcreditfile->save();
                }

                return redirect()->back()->with('success', 'Pinjaman Ini Diterima');
            } catch (\Throwable $th) {
                dd($th);
                return redirect()->back()->with('error', 'Pinjaman Ini Ditolak');
            }
        }

        if ($buttonValue == 'ditolak') {
            try {
                $credit = Credit::find($id);
                $reviewcredit = new ReviewCredit();
                $reviewcreditfile = new ReviewCreditFile();

                $validated = $request->validate([
                    'no_nota' => 'required',
                    'keterangan_review_pinajaman' => 'required',
                    'upload_bukti_transfer_review' => 'required',
                ]);

                $credit->status_credit = 'ditolak';
                $credit->status_ketua = 'ditolak';
                $credit->loan_interest = 0;
                $credit->penalty = 0;
                $credit->save();

                $reviewcredit->no_nota = $request->input('no_nota');
                $reviewcredit->keterangan = $request->input('keterangan_review_pinajaman');
                $reviewcredit->credit_id = $id;
                $reviewcredit->author_id = Auth::id();
                $reviewcredit->save();

                if ($request->hasFile('upload_bukti_transfer_review')) {
                    $fileName = $request->upload_bukti_transfer_review->getClientOriginalName();

                    // Menyimpan data pada storage local
                    Storage::putFileAs('public/files', $request->upload_bukti_transfer_review, $fileName);
                    // Menyimpan File pada database File Data Pinjaman
                    $reviewcreditfile->files = $fileName;
                    $reviewcreditfile->review_credit_id = $reviewcredit->id;
                    $reviewcreditfile->save();
                }

                return redirect()->back()->with('error', 'Pinjaman ini Ditolak');
            } catch (\Throwable $th) {
                dd($th);
                return redirect()->back()->with('error', 'Pinjaman ini Ditolak');
            }
        }

    }

    // public function store_installment(Request $request, $id)
    // {
    //     try {
    //         $credit = Credit::find($id);
    //         $installment = new Installment();
    //         $installmentfile = new InstallmentFile();

    //         // Validasi yang wajib diinputkan pada request payloads
    //         $validated = $request->validate([
    //             'nominal_angsuran' => 'required',
    //             'tanggal_transfer_angsuran' => 'required',
    //             'keterangan_angsuran' => 'required',
    //             'upload_bukti_angsuran' => 'required',
    //         ]);

    //         $currentDate = Carbon::parse($request->input('tanggal_transfer_angsuran'));

    //         if ($currentDate->greaterThan($credit->due_date)) {
    //             $installment->nominal_angsuran = $request->input('nominal_angsuran');
    //             $installment->keterangan = $request->input('keterangan_angsuran');
    //             $installment->tanggal_transfer = $request->input('tanggal_transfer_angsuran');
    //             $installment->author_id = Auth::id();
    //             $installment->author_name = Auth::user()->name;
    //             $installment->credit_id = $id;
    //             $installment->save();

    //             // Fungsi untuk mengambil tanggal
    //             $toDate = Carbon::parse($credit->due_date);
    //             $fromDate = Carbon::parse($currentDate);

    //             // Fungsi untuk menghitung denda
    //             $countdayslate = $toDate->diffInDays($fromDate);
    //             $denda = $credit->penalty * $countdayslate;
    //             $hitung_denda = $request->input('nominal_angsuran') - $denda;

    //             // Fungsi untuk menyimpan denda
    //             $credit->total_terbayar = $credit->total_terbayar + $hitung_denda;
    //             $credit->save();

    //             // Melakukan pengecekan jika inputan memiliki File
    //             if ($request->hasFile('upload_bukti_angsuran')) {
    //                 $fileName = $request->upload_bukti_angsuran->getClientOriginalName();

    //                 // Menyimpan data pada storage local
    //                 Storage::putFileAs('public/files', $request->upload_bukti_angsuran, $fileName);
    //                 // Menyimpan File pada database File Surat Masuk
    //                 $installmentfile->files = $fileName;
    //                 $installmentfile->id_installments = $installment->id;
    //                 $installmentfile->save();
    //             }

    //         } else {
    //             $installment->nominal_angsuran = $request->input('nominal_angsuran');
    //             $installment->tanggal_transfer = $request->input('tanggal_transfer_angsuran');
    //             $installment->keterangan = $request->input('keterangan_angsuran');
    //             $installment->author_id = Auth::id();
    //             $installment->author_name = Auth::user()->name;
    //             $installment->credit_id = $id;
    //             $installment->save();

    //             $hutang_terbayar = $credit->total_terbayar + $installment->nominal_pinjaman = $request->input('nominal_angsuran');
    //             $credit->total_terbayar = $hutang_terbayar;
    //             $credit->save();

    //             // Melakukan pengecekan jika inputan memiliki File
    //             if ($request->hasFile('upload_bukti_angsuran')) {
    //                 $fileName = $request->upload_bukti_angsuran->getClientOriginalName();

    //                 // Menyimpan data pada storage local
    //                 Storage::putFileAs('public/files', $request->upload_bukti_angsuran, $fileName);
    //                 // Menyimpan File pada database File Data Pinjaman
    //                 $installmentfile->files = $fileName;
    //                 $installmentfile->id_installments = $installment->id;
    //                 $installmentfile->save();
    //             }
    //         }

    //         return redirect()->back()->with('success', 'Berhasil menambahkan Angsuran');
    //     } catch (\Throwable $th) {
    //         dd($th);
    //         return redirect()->back()->with('error', 'Gagal menambahkan Angsuran');
    //     }
    // }
}
