<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Update lokasi latitude dan longitude user yang sedang login.
     */
    public function storeLocation(Request $request)
    {
        // 1. Validasi input: pastikan data ada dan berupa angka
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // 2. Ambil user yang sedang login (pake Sanctum)
        $user = Auth::user();

        // 3. Update data di database
        $user->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // 4. Balikin respon JSON
        return response()->json([
            'success' => true,
            'message' => 'Lokasi Anda berhasil diperbarui!',
            'data'    => [
                'latitude' => $user->latitude,
                'longitude' => $user->longitude,
            ]
        ], 200);
    }
}