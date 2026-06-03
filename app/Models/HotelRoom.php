<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    // 1. Beritahu Laravel kalau model ini memakai nama tabel 'hotel_rooms'
    protected $table = 'hotel_rooms';

    // 2. Daftarkan kolom yang boleh diisi lewat fitur CRUD nanti
    protected $fillable = [
        'hotel_id',
        'category_id',
        'price',
        'facilities',
        'image'
    ];

    // 3. Relasi balik ke model Hotel (Biar kamar tahu dia milik hotel mana)
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    // 4. Relasi ke model Category (Biar kamar tahu dia tipe 'Budget' atau 'Luxury')
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}