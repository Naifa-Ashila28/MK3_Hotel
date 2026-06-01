<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;

class UserController extends Controller
{
    public function storeLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // 1. Ambil koordinat HP user
        $uLat = (double) $request->latitude;
        $uLng = (double) $request->longitude;

        $user->update(['latitude' => $uLat, 'longitude' => $uLng]);

        // 2. HITUNG JARAK AMAN (Menggunakan fungsi deg2rad bawaan PHP)
        // Koordinat Pusat Kota Purwokerto: -7.4243, 109.2302
        // Koordinat Pusat Kota Jakarta: -6.2088, 106.8456
        
        // Jarak ke Purwokerto
        $jarakKePwt = 6371 * acos(
            cos(deg2rad($uLat)) * cos(deg2rad(-7.4243)) * cos(deg2rad(109.2302) - deg2rad($uLng)) + 
            sin(deg2rad($uLat)) * sin(deg2rad(-7.4243))
        );
        
        // Jarak ke Jakarta
        $jarakKeJkt = 6371 * acos(
            cos(deg2rad($uLat)) * cos(deg2rad(-6.2088)) * cos(deg2rad(106.8456) - deg2rad($uLng)) + 
            sin(deg2rad($uLat)) * sin(deg2rad(-6.2088))
        );

        // 3. Tentukan kota rekomendasi mana yang paling dekat gres
        $kotaTerdekat = ($jarakKePwt < $jarakKeJkt) ? 'Purwokerto' : 'Jakarta';

        // 4. Tarik hotel terdekat berdasarkan kota yang dipilih beserta relasi tipe kamarnya
        $hotelRekomendasi = Hotel::with('rooms')
            ->where('location', 'LIKE', '%' . $kotaTerdekat . '%')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Sukses mendeteksi kota terdekat',
            'data' => [
                'kota_terdekat' => $kotaTerdekat,
                'hotels' => $hotelRekomendasi
            ]
        ], 200);
    }
}