<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
