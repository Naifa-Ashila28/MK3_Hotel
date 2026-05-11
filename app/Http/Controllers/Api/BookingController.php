<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Membuat Booking
public function store(Request $request)
{
    return response()->json([
        "status" => true,
        "message" => "Booking berhasil",
        "data" => [
            "booking_id" => 1,
            "hotel_id" => $request->hotel_id,
            "user_id" => $request->user_id
        ]
    ], 201);
}

// Membatalkan Booking
public function destroy($id)
{
    return response()->json([
        "status" => true,
        "message" => "Booking berhasil dibatalkan"
    ], 200);
}
}
