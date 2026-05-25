<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Memanggil model Category
use App\Models\Hotel;    // Memanggil model Hotel

class HotelController extends Controller
{
    // 1. [READ] Fungsi untuk mengambil SEMUA daftar hotel
    public function index()
    {
        // Mengambil semua data dari tabel hotels beserta relasi kategorinya agar rapi
        $data = Hotel::with('category')->get(); 
        return response()->json([
            "status" => true,
            "message" => "List Semua Hotel dari Database",
            "data" => $data
        ]);
    }

    // 2. [READ] Fungsi untuk mengambil SEMUA kategori
    public function categories()
    {
        $data = Category::all(); // Mengambil semua data dari tabel categories
        return response()->json([
            "status" => true,
            "message" => "List Kategori dari Database",
            "data" => $data
        ]);
    }

    // 3. [READ] Fungsi untuk detail hotel berdasarkan ID
    public function show($id)
    {
        $data = Hotel::with('category')->find($id); // Mencari hotel berdasarkan ID beserta kategorinya
        
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

    // 4. [CREATE] Fungsi untuk menambah hotel baru (Sisi Admin)
    public function store(Request $request)
    {
        // Validasi data input dari admin agar tidak ada data kosong atau error
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
            'location' => 'required|string',
            'rating' => 'required|numeric',
            'image' => 'nullable|string' // jika ada upload image dalam bentuk string/path
        ]);

        // Menyimpan data divalidasi ke database
        $hotel = Hotel::create($validated);

        return response()->json([
            "status" => true,
            "message" => "Hotel berhasil ditambahkan oleh Admin!",
            "data" => $hotel
        ], 201); // Status 201 artinya Created (Berhasil Dibuat)
    }

    // 5. [UPDATE] Fungsi untuk mengedit data hotel berdasarkan ID (Sisi Admin)
    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json([
                "status" => false,
                "message" => "Hotel tidak ditemukan"
            ], 404);
        }

        // Validasi data yang masuk. 'nullable' artinya kalau tidak diisi/diubah, tidak apa-apa
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|integer',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'image' => 'nullable|string'
        ]);

        // Menyaring data yang dikirim dan melakukan update
        $hotel->update(array_filter($validated));

        return response()->json([
            "status" => true,
            "message" => "Data hotel berhasil diperbarui oleh Admin!",
            "data" => $hotel
        ], 200);
    }

    // 6. [DELETE] Fungsi untuk menghapus data hotel berdasarkan ID (Sisi Admin)
    public function destroy($id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json([
                "status" => false,
                "message" => "Hotel tidak ditemukan"
            ], 404);
        }

        // Menghapus data dari database
        $hotel->delete();

        return response()->json([
            "status" => true,
            "message" => "Hotel berhasil dihapus dari database oleh Admin!"
        ], 200);
    }
}