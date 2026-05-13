<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Payment;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        return response()->json([
            "status" => true,
            "message" => "Pembayaran berhasil",
            "data" => [
                "payment_id" => 10,
                "status" => "paid"
            ]
        ], 200);
    }
}