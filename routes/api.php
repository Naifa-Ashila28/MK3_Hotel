<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
// Import semua controller yang bakal kita pakai (nanti lu bikin satu-satu controllernya)
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PaymentController;

// 1. Membuat pemesanan hotel
Route::post('/booking', [BookingController::class, 'store']);

// 2. Membatalkan booking berdasarkan ID
Route::delete('/booking/{id}', [BookingController::class, 'destroy']);

// 3. Login user
Route::post('/login', [AuthController::class, 'login']);

// 4. Ambil kategori hotel
Route::get('/categories', [HotelController::class, 'categories']);

// 5. Melakukan pembayaran
Route::post('/payment', [PaymentController::class, 'pay']);

// 6. Menampilkan detail hotel berdasarkan ID
Route::get('/hotels/{id}', [HotelController::class, 'show']);
=======
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
>>>>>>> daefc0535417a40d194096683575523dfc7f43ca
