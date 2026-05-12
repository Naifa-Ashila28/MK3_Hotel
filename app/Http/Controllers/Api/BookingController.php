<?php

namespace App\Http\Controllers\Api; // <-- Ini alamat barunya!

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking; 

class BookingController extends Controller
{
    public function store(Request $request)
    {
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