<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import semua controller sesuai folder Api
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReviewController;

// Fitur Login & Register dasar
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/hotels', [HotelController::class, 'index']);
Route::get('/hotels/{id}', [HotelController::class, 'show']);
Route::post('/hotels', [HotelController::class, 'store']);  
Route::put('/hotels/{id}', [HotelController::class, 'update']);   
Route::delete('/hotels/{id}', [HotelController::class, 'destroy']); 

// Fitur Kategori Hotel - Disatukan di sini!
Route::get('/categories', [HotelController::class, 'categories']);
Route::post('/categories', [HotelController::class, 'storeCategory']);
Route::put('/categories/{id}', [HotelController::class, 'updateCategory']);
Route::delete('/categories/{id}', [HotelController::class, 'destroyCategory']);

// Fitur Review & Rating
Route::get('/review', [ReviewController::class, 'index']); 
Route::post('/review', [ReviewController::class, 'store']);

//Aman, harus make sistem login ini
Route::middleware('auth:sanctum')->group(function () {
    
    // Fitur Booking Hotel
    Route::get('/booking', [BookingController::class, 'index']);   
    Route::post('/booking', [BookingController::class, 'store']);
    Route::delete('/booking/{id}', [BookingController::class, 'destroy']);

    // ====== PINDAHKAN PAYMENT KE SINI BIAR GEMBOKNYA AMAN ======
    Route::post('/payment', [PaymentController::class, 'pay']);

    // Fitur Kirim Lokasi GPS HP Android
    Route::post('/user/location', [UserController::class, 'storeLocation']);
    
    // Fitur Ambil Profil & Keluar Aplikasi (Logout)
    Route::get('/user', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});