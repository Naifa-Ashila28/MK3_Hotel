<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id',
    ];

    // Memastikan tipe data yang keluar dari API sudah sesuai standar
    protected $casts = [
        'booking_id' => 'integer',
        'amount' => 'integer', 
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}