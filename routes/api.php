<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import controller sesuai folder Api
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\UserController;

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
});
// 6. Menampilkan detail hotel berdasarkan ID (Spesifik satu hotel)
Route::get('/hotels/{id}', [HotelController::class, 'show']);

// 7. INI YANG BARU: Menampilkan daftar SEMUA hotel
// Baris ini yang bikin http://127.0.0.1:8000/api/hotels kamu nggak error 404 lagi
Route::get('/hotels', [HotelController::class, 'index']);
