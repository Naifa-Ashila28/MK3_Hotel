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

    // COCOKAN DENGAN AKUN REQUEST LU, CUK!
    if ($username === 'admin' && $password === 'admin123') {
        session(['admin_logged_in' => true]);
        return redirect('/admin/dashboard');
    }

    return redirect('/admin/login')->with('error', 'Username atau Password salah, cuk!');
});

// 3. Halaman Dashboard Admin (DIPROTEKSI SESSION)
Route::get('/admin/dashboard', function () {
    // Wajibin login, kalau belum login tendang balik ke halaman login
    if (!session()->has('admin_logged_in')) {
        return redirect('/admin/login')->with('error', 'Wajib login dulu, bos!');
    }

    $totalUser = DB::table('users')->count();
    $dataUser = DB::table('users')->orderBy('created_at', 'desc')->get();

    return view('admin.dashboard', compact('totalUser', 'dataUser'));
});

// 4. Proses Logout Admin
Route::get('/admin/logout', function () {
    session()->forget('admin_logged_in'); // Hapus tanda login
    return redirect('/admin/login')->with('error', 'Berhasil keluar dashboard!');
});