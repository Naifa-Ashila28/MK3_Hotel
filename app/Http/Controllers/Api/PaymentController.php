<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment; 
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        // 1. Validasi Input (Mencegah pengiriman data kosong/salah dari Android)
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|integer',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string'
        ]);

        // Jika validasi gagal, kembalikan pesan error 422
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data pembayaran tidak lengkap',
                'errors' => $validator->errors()
            ], 422); 
        }

        // 2. Simpan data ke Database menggunakan Eloquent ORM
        $payment = Payment::create([
            'booking_id' => $request->booking_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => 'paid' 
        ]);

        // 3. Kembalikan Response Sukses (201 Created) ke aplikasi Android
        return response()->json([
            "status" => true,
            "message" => "Pembayaran berhasil diproses",
            "data" => [
                "payment_id" => $payment->id, 
                "booking_id" => $payment->booking_id,
                "amount" => $payment->amount,
                "status" => $payment->status
            ]
        ], 201); 
    }
}