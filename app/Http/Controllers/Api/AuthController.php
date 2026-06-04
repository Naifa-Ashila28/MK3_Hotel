<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi inputan dari Android dulu biar formatnya bener
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // 2. Cari usernya di database berdasarkan email
        $user = User::where('email', $request->email)->first();

        // 3. PENGAMAN SAKRAL: Jika user gak ketemu ATAU password-nya salah, langsung tolak!
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah, bree!'
            ], 401); // 401 artinya Unauthorized (tidak diizinkan)
        }

        // 4. Kalau lolos seleksi di atas, hapus token lama (biar gak numpuk)
        $user->tokens()->delete();

        // 5. Bikin token baru
        $token = $user->createToken('auth_token')->plainTextToken;

        // 6. Lempar respon sukses ke Android Studio
        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user_id' => $user->id,
                'token' => $token, 
            ]
        ], 200);
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, 
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Registrasi berhasil!',
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ], 201);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil logout, token telah dihapus.'
        ], 200);
    }
    public function profile(Request $request)
    {
        // Narik data user yang sedang login berdasarkan token Sanctum secara realtime
        return response()->json([
            'status' => true,
            'message' => 'Data profil berhasil diambil',
            'data' => $request->user() // Otomatis ngirim id, name, email, phone dari MySQL
        ], 200);
    }
}
