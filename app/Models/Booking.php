<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_name', 
    'hotel_id', // Pastikan ini hotel_id, bukan nama_hotel
    'durasi'
];
}