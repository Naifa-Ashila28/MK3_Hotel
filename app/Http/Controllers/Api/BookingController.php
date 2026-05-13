<?php

namespace App\Http\Controllers\Api; // <-- Ini alamat barunya!

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking; 

class BookingController extends Controller
{
   public function store(Request $request)
{
    // Pastikan tidak ada lagi kata 'nama_hotel' atau 'kota' di sini
$simpan = Booking::create([
    'user_name' => $request->user_name,
    'hotel_id'  => $request->hotel_id, 
    'durasi'    => $request->durasi,
]);

    return response()->json([
        'status' => 'sukses',
        'pesan'  => 'Booking di cabang ' . $request->kota . ' berhasil dicatat!',
        'data'   => $simpan
    ], 201);
}

    public function destroy($id)
    {
        $hapus = Booking::find($id);
        
        if($hapus) {
            $hapus->delete();
            return response()->json([   
                'status' => 'sukses',
                'pesan' => 'Pesanan ID ' . $id . ' pesanan sudah hilang dari database.'
            ], 200);
        }

        return response()->json([
            'status' => 'gagal',
            'pesan' => 'Data tidak ada/tidak ketemu.'
        ], 404);
    }
}