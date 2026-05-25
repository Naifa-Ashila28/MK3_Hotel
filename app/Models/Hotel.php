<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    // 1. Mendaftarkan kolom yang BOLEH diisi lewat Postman (Sisi Admin CRUD)
    protected $fillable = [
        'category_id', 
        'name', 
        'image', 
        'price', 
        'description', 
        'location', 
        'rating'
    ];

    // 2. RELASI: Menyatakan bahwa Hotel "Milik" (belongsTo) sebuah Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}