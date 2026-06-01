<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    // 1. Tambahkan latitude & longitude ke dalam fillable biar bisa diisi koordinat maps-nya
    protected $fillable = [
        'category_id', 
        'name', 
        'image', 
        'price', 
        'description', 
        'location', 
        'rating',
        'latitude',  // <-- WAJIB DITAMBAHIN
        'longitude'  // <-- WAJIB DITAMBAHIN
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'hotel_id', 'id');
    }
}