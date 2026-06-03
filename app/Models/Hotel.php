<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    // Sesuaikan fillable dengan migration terbaru (Hapus price, description, category_id)
    protected $fillable = [
        'name', 
        'city',        // Tambah kolom kota
        'location',    // Ini nama jalan
        'rating',
        'image', 
    ];

    // Hubungkan ke tabel hotel_rooms (Pastikan nama modelnya HotelRoom, beralamat di App\Models\HotelRoom)
    public function rooms()
    {
        return $this->hasMany(HotelRoom::class, 'hotel_id', 'id');
    }
}