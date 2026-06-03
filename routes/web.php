<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// 1. Halaman Login Admin
Route::get('/admin/login', function () {
    if (session()->has('admin_logged_in')) {
        return redirect('/admin/dashboard');
    }
    return view('admin.login');
});

// 2. Proses Validasi Form Login
Route::post('/admin/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    if ($username === 'admin' && $password === 'admin123') {
        session(['admin_logged_in' => true]);
        return redirect('/admin/dashboard');
    }

    return redirect('/admin/login')->with('Username atau Password salah');
});

// 3. Halaman Dashboard Admin
Route::get('/admin/dashboard', function () {
    if (!session()->has('admin_logged_in')) {
        return redirect('/admin/login')->with( 'Wajib login dulu');
    }

    try { $dataUser = DB::table('users')->get(); } catch (\Exception $e) { $dataUser = collect(); }
    try { $dataBooking = DB::table('bookings')->orderBy('created_at', 'desc')->get(); } catch (\Exception $e) { $dataBooking = collect(); }
    try { $dataPayment = DB::table('payments')->orderBy('created_at', 'desc')->get(); } catch (\Exception $e) { $dataPayment = collect(); }
    try { $dataReview = DB::table('reviews')->orderBy('created_at', 'desc')->get(); } catch (\Exception $e) { $dataReview = collect(); }

    return view('admin.dashboard', compact('dataUser', 'dataBooking', 'dataPayment', 'dataReview'));
});

// 4. Proses Logout Admin
Route::get('/admin/logout', function () {
    session()->forget('admin_logged_in'); 
    return redirect('/admin/login')->with('error', 'Berhasil keluar dashboard!');
});