<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'sukses', 'data' => Review::all()], 200);
    }

    public function store(Request $request)
    {
        $simpan = Review::create([
            'user_name'  => $request->user_name,
            'nama_hotel' => $request->nama_hotel,
            'rating'     => $request->rating,
            'komentar'   => $request->komentar,
        ]);

        return response()->json(['status' => 'sukses', 'data' => $simpan], 201);
    }
}