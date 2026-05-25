<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Memanggil model Category
use App\Models\Hotel;    // Memanggil model Hotel

class HotelController extends Controller
{
    // ==========================================
    // 🏢 Bagian 1: CRUD HOTELS (Hotel & Cabang)
    // ==========================================

    // 1. [READ] Fungsi untuk mengambil SEMUA daftar hotel beserta kategorinya
    public function index()
    {
        $data = Hotel::with('category')->get(); 
        return response()->json([
            "status" => true,
            "message" => "List Semua Hotel dari Database",
            "data" => $data
        ]);
    }

    // 2. [READ] Fungsi untuk detail hotel berdasarkan ID
    public function show($id)
    {
        $data = Hotel::with('category')->find($id); 
        
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

    // 3. [CREATE] Fungsi untuk menambah hotel baru (Sisi Admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
            'location' => 'required|string',
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

    // 4. [UPDATE] Fungsi untuk mengedit data hotel berdasarkan ID (Sisi Admin)
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
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|integer',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
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

    // 5. [DELETE] Fungsi untuk menghapus data hotel berdasarkan ID (Sisi Admin)
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

    // 1. [READ] Fungsi untuk mengambil SEMUA kategori
    public function categories()
    {
        $data = Category::all(); 
        return response()->json([
            "status" => true,
            "message" => "List Kategori dari Database",
            "data" => $data
        ]);
    }

    // 2. [CREATE] Fungsi untuk menambah kategori baru (Sisi Admin)
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

    // 3. [UPDATE] Fungsi untuk mengubah nama kategori berdasarkan ID (Sisi Admin)
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

    // 4. [DELETE] Fungsi untuk menghapus kategori berdasarkan ID (Sisi Admin)
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