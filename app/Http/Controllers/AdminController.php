<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Review;

class AdminController extends Controller
{
    public function index()
    {
        $dataUser    = User::all();
        $dataBooking = Booking::latest()->get();
        $dataPayment = Payment::latest()->get();
        $dataReview  = Review::latest()->get();

        return view('admin.admin', compact('dataUser', 'dataBooking', 'dataPayment', 'dataReview'));
    }
}