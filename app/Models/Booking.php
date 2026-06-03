<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'email',
        'hotel_id',
        'jenis_kamar',
        'waktu_pemesanan',
        'status'
    ];
}