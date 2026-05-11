<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Tambahin ini biar Laravel izinin kolom-kolom ini diisi lewat Postman
    protected $fillable = [
        'user_name', 
        'hotel_id', 
        'durasi'
    ];
}