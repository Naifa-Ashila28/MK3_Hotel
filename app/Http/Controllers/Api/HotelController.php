<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // Ambil Semua Kategori
public function categories()
{
    return response()->json([
        "status" => true,
        "message" => "List Kategori",
        "data" => [
            ["id" => 1, "name" => "Budget"],
            ["id" => 2, "name" => "Luxury"]
        ]
    ], 200);
}

// Detail Hotel Berdasarkan ID
public function show($id)
{
    return response()->json([
        "status" => true,
        "message" => "Detail Hotel",
        "data" => [
            "id" => $id,
            "name" => "StayIn Alun Alun Purwokerto",
            "location" => "Purwokerto",
            "price" => 300000,
            "rating" => 4.6,
            "facilities" => ["WIFI", "AC", "TV", "Towel"]
        ]
    ], 200);
}
}
