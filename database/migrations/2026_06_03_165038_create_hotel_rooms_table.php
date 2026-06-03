<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->id();
            
            // 1. Foreign Key ke tabel 'hotels' (Mengikat ke hotel mana)
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            
            // 2. Foreign Key ke tabel 'categories' (Mengikat ke jenis 'Budget' atau 'Luxury')
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            
            // 3. Data dinamis kamar yang bisa di-CRUD bebas per hotel (Beda kota beda isi)
            $table->integer('price');       // Harga dinamis menyesuaikan UMR kota setempat
            $table->string('facilities');   // Fasilitas (Misal: "Free Wi-Fi, AC, TV")
            $table->string('image');        // Nama file gambar kamar untuk hotel tersebut
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_rooms');
    }
};