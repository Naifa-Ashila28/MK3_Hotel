<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_name', 
    'nama_hotel', 
    'kota', 
    'durasi'
];

    // INI TAMBAHANNYA: Bikin relasi ke tabel hotels
    public function hotel()
    {
        // Artinya: Booking ini punya data nyambung ke Model Hotel berdasarkan hotel_id
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}