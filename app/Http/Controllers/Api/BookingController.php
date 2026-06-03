<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking; 
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $booking = Booking::where('email', $user->email)->get();
        } else {
            $booking = Booking::all();
        }

        return response()->json($booking, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required',
            'jenis_kamar' => 'required',
            'waktu_pemesanan' => 'required'
        ]);

        $user = Auth::user();

        $simpan = Booking::create([
            'email'           => $user ? $user->email : ($request->email ?? 'user@stayin.com'),
            'hotel_id'        => $request->hotel_id, 
            'jenis_kamar'     => $request->jenis_kamar,
            'waktu_pemesanan' => $request->waktu_pemesanan,
            'status'          => 'unpaid',
        ]);

        return response()->json([
            'status' => 'sukses',
            'pesan'  => 'Booking berhasil dicatat!', 
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