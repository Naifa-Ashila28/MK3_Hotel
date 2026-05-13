<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // ... (komentar dan $table kamu biarkan saja seperti aslinya)
    protected $table = 'payments';

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id',
    ];

    /**
     * Memastikan tipe data yang keluar dari API sudah sesuai standar.
     * Ini sangat membantu frontend Android (Retrofit/Kotlin) saat mapping data.
     */
    protected $casts = [
        'booking_id' => 'integer',
        'amount' => 'integer', // atau 'double' jika ada nilai desimal
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}