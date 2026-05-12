<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    // Ini PENTING: Supaya database bisa diisi lewat Postman tanpa error
    protected $guarded = []; 
}