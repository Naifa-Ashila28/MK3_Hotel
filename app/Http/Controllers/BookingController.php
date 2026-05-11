<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Fungsi untuk BIKIN pesanan (POST)
    public function store(Request $request)
    {
        // Ibaratnya ini berhasil nyimpen data ke database
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Mantap, pesanan hotel berhasil dibuat!',
            'data_yang_dikirim' => $request->all()
        ], 201);
    }

    // Fungsi untuk BATALIN pesanan (DELETE)
    public function destroy($id)
    {
        // Ibaratnya ini berhasil ngehapus data di database berdasarkan ID
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Pesanan dengan ID ' . $id . ' berhasil dibatalkan/dihapus.'
        ], 200);
    }
}