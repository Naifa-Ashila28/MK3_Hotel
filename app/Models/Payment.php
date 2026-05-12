<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (opsional jika nama tabel Anda sudah plural 'payments').
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * Kolom-kolom yang diizinkan untuk diisi secara massal (Mass Assignment).
     * Sesuaikan array ini dengan nama kolom yang ada di database/migration Anda.
     *
     * @var array
     */
    protected $fillable = [
        'booking_id',      // ID dari tabel bookings
        'amount',          // Jumlah yang dibayarkan
        'payment_method',  // Metode pembayaran (cth: bank_transfer, credit_card, cash)
        'status',          // Status pembayaran (cth: unpaid, paid, failed, expired)
        'transaction_id',  // ID dari payment gateway (jika ada)
    ];

    /**
     * Relasi ke model Booking.
     * Setiap pembayaran dimiliki oleh satu booking.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}