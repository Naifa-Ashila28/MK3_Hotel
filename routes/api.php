<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import controller sesuai folder Api
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReviewController; // <-- TAMBAHAN: Import buat fitur review

// 1. Membuat pemesanan hotel
Route::post('/booking', [BookingController::class, 'store']);

// 2. Membatalkan booking berdasarkan ID
Route::delete('/booking/{id}', [BookingController::class, 'destroy']);

// 3. Login user
Route::post('/login', [AuthController::class, 'login']);

// 4. Ambil kategori hotel (Luxury/Budget)
Route::get('/categories', [HotelController::class, 'categories']);

// 5. Melakukan pembayaran
Route::post('/payment', [PaymentController::class, 'pay']);

// 6. Menampilkan detail hotel berdasarkan ID
Route::get('/hotels/{id}', [HotelController::class, 'show']);

// 7. Untuk Lokasi
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user/location', [UserController::class, 'storeLocation']);
    // untuk logout
Route::post('/logout', [AuthController::class, 'logout']);
});

// 6. Menampilkan detail hotel berdasarkan ID (Spesifik satu hotel)
Route::get('/hotels/{id}', [HotelController::class, 'show']);

// 7. Menampilkan daftar SEMUA hotel
Route::get('/hotels', [HotelController::class, 'index']);
Route::post('/hotels', [HotelController::class, 'store']);  // Pintu buat Create (Method POST)
Route::put('/hotels/{id}', [HotelController::class, 'update']);   // Pintu buat Update (Method PUT)
Route::delete('/hotels/{id}', [HotelController::class, 'destroy']); // Pintu buat Delete (Method DELETE)

// --- ROUTE GROUP UNTUK CATEGORIES ---
Route::get('/categories', [HotelController::class, 'categories']);
Route::post('/categories', [HotelController::class, 'storeCategory']);
Route::put('/categories/{id}', [HotelController::class, 'updateCategory']);
Route::delete('/categories/{id}', [HotelController::class, 'destroyCategory']);


// --- FITUR BARU: REVIEW & RATING ---
// Untuk melihat semua ulasan yang masuk
Route::get('/review', [ReviewController::class, 'index']); 

// Untuk mengirim ulasan baru dari aplikasi Android
Route::post('/review', [ReviewController::class, 'store']);

// untuk register
Route::post('/register', [AuthController::class, 'register']);

// untuk profil
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'profile']);

