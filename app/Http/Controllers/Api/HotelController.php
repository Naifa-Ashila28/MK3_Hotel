<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Hotel;    

class HotelController extends Controller
{
    // ==========================================
    // 🏢 Bagian 1: CRUD HOTELS (Hotel & Cabang)
    // ==========================================

    // 1. [READ] Mengambil semua hotel sekalian angkut data kamar dan nama kategorinya
    public function index()
    {
        // Menggunakan rooms.category agar data kamar beserta label 'Budget'/'Luxury' ikut terbawa
        $data = Hotel::with('rooms.category')->get(); 
        return response()->json([
            "status" => true,
            "message" => "List Semua Hotel dari Database",
            "data" => $data
        ]);
    }

    // 2. [READ] JAWABAN UTAMA: Mengambil detail 1 hotel beserta pilihan kamarnya yang dinamis
    public function show($id)
    {
        // Estafet relasi: Ambil Hotel -> Ambil Kamar-kamarnya -> Ambil Nama Kategori Kamarnya
        $data = Hotel::with('rooms.category')->find($id); 
        
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

    // 3. [CREATE] Menambah hotel baru (Sudah disesuaikan dengan kolom city & tanpa deskripsi/harga bawaan)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',       // Kolom penanda kota (Purwokerto, Jakarta, dll)
            'location' => 'required|string',           // Kolom untuk nama jalan / alamat lengkap
            'rating' => 'required|numeric',
            'image' => 'nullable|string'
        ]);

        $hotel = Hotel::create($validated);

        return response()->json([
            "status" => true,
            "message" => "Hotel berhasil ditambahkan oleh Admin!",
            "data" => $hotel
        ], 201); 
    }

    // 4. [UPDATE] Mengedit data hotel berdasarkan ID (Sisi Admin)
    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json([
                "status" => false,
                "message" => "Hotel tidak ditemukan"
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',       // Mengubah kota secara dinamis
            'location' => 'nullable|string',           // Mengubah nama jalan secara dinamis
            'rating' => 'nullable|numeric',
            'image' => 'nullable|string'
        ]);

        $hotel->update(array_filter($validated));

        return response()->json([
            "status" => true,
            "message" => "Data hotel berhasil diperbarui oleh Admin!",
            "data" => $hotel
        ], 200);
    }

    // 5. [DELETE] Hapus data hotel berdasarkan ID (Sisi Admin)
    public function destroy($id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json([
                "status" => false,
                "message" => "Hotel tidak ditemukan"
            ], 404);
        }

        $hotel->delete();

        return response()->json([
            "status" => true,
            "message" => "Hotel berhasil dihapus dari database oleh Admin!"
        ], 200);
    }


    // ==========================================
    // 🗂️ Bagian 2: CRUD CATEGORIES (Kategori Kamar)
    // ==========================================

    // 1. [READ] Mengambil semua master kategori kamar
    public function categories()
    {
        $data = Category::all(); 
        return response()->json([
            "status" => true,
            "message" => "List Kategori dari Database",
            "data" => $data
        ]);
    }

    // 2. [CREATE] Menambah master kategori baru (Misal: Budget / Luxury)
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name' 
        ]);

        $category = Category::create($validated);

        return response()->json([
            "status" => true,
            "message" => "Kategori baru berhasil ditambahkan oleh Admin!",
            "data" => $category
        ], 201);
    }

    // 3. [UPDATE] Mengubah nama kategori berdasarkan ID
    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                "status" => false,
                "message" => "Kategori tidak ditemukan"
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id
        ]);

        $category->update($validated);

        return response()->json([
            "status" => true,
            "message" => "Nama kategori berhasil diperbarui oleh Admin!",
            "data" => $category
        ], 200);
    }

    // 4. [DELETE] Menghapus kategori berdasarkan ID
    public function destroyCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                "status" => false,
                "message" => "Kategori tidak ditemukan"
            ], 404);
        }

        $category->delete();

        return response()->json([
            "status" => true,
            "message" => "Kategori berhasil dihapus dari database oleh Admin!"
        ], 200);
    }
}