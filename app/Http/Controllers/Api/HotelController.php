<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Memanggil model Category
use App\Models\Hotel;    // Memanggil model Hotel

class HotelController extends Controller
{
    // 1. Fungsi untuk mengambil SEMUA daftar hotel
    public function index()
    {
        $data = Hotel::all(); // Mengambil semua data dari tabel hotels
        return response()->json([
            "status" => true,
            "message" => "List Semua Hotel dari Database",
            "data" => $data
        ]);
    }

    // 2. Fungsi untuk mengambil SEMUA kategori
    public function categories()
    {
        $data = Category::all(); // Mengambil semua data dari tabel categories
        return response()->json([
            "status" => true,
            "message" => "List Kategori dari Database",
            "data" => $data
        ]);
    }

    // 3. Fungsi untuk detail hotel berdasarkan ID
    public function show($id)
    {
        $data = Hotel::find($id); // Mencari hotel berdasarkan ID di tabel hotels
        
        if (!$data) {
            return response()->json([
                "status" => false, 
                "message" => "Hotel tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "status" => true,
            "message" => "Detail Hotel dari Database",
            "data" => $data
        ]);
    }
}