<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/admin/dashboard', function () {
    // 1. Hitung total user terdaftar untuk card statistik
    $totalUser = DB::table('users')->count();

    // 2. Ambil semua data user yang ada di database
    // Pastiin di table 'users' lu emang ada kolom 'latitude' dan 'longitude' ya!
    $dataUser = DB::table('users')
        ->orderBy('created_at', 'desc') // Yang baru login/daftar ditaruh paling atas
        ->get();

    // 3. Oper datanya ke view admin
    return view('admin.dashboard', compact('totalUser', 'dataUser'));
});