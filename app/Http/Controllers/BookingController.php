<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 1. INI WAJIB: Biar Controller lu kenal sama kurir (Model) Booking
use App\Models\Booking; 

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // 2. Perintah ini yang beneran nyimpen ke database
        $simpan = Booking::create([
            'user_name' => $request->user_name,
            'hotel_id'  => $request->hotel_id,
            'durasi'    => $request->durasi,
        ]);

        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Data SEKARANG beneran masuk ke phpMyAdmin!',
            'data_di_database' => $simpan
        ], 201);
    }

    public function destroy($id)
    {
        // 3. Perintah ini yang beneran ngehapus dari database berdasarkan ID
        $hapus = Booking::find($id);
        
        if($hapus) {
            $hapus->delete();
            return response()->json([
                'status' => 'sukses',
                'pesan' => 'Pesanan ID ' . $id . ' udah ilang dari database.'
            ], 200);
        }

        return response()->json([
            'status' => 'gagal',
            'pesan' => 'Data nggak ketemu, Bim.'
        ], 404);
    }
}