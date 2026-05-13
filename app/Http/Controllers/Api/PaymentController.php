<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment; // KOREKSI: Path model yang benar sesuai gambar adalah App\Models, bukan App\Http\Models
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        // 1. Validasi Input (Ini yang mencegah request kosong)
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|integer',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string'
        ]);

        // Jika validasi gagal, kembalikan pesan error ke Postman / Android
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data pembayaran tidak lengkap',
                'errors' => $validator->errors()
            ], 422); // 422 adalah kode Unprocessable Entity (Input bermasalah)
        }

        // 2. Simpan data ke Database melalui Model Payment
        // Catatan: Pastikan field fillable di model Payment sudah diatur
        $payment = Payment::create([
            'booking_id' => $request->booking_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => 'paid' // Otomatis diset paid saat fungsi ini dipanggil
        ]);

        // 3. Kembalikan Response Sukses yang Dinamis
        return response()->json([
            "status" => true,
            "message" => "Pembayaran berhasil diproses",
            "data" => [
                "payment_id" => $payment->id, // ID asli dari database
                "booking_id" => $payment->booking_id,
                "amount" => $payment->amount,
                "status" => $payment->status
            ]
        ], 201); // 201 adalah kode Created (Data berhasil dibuat di database)
    }
}