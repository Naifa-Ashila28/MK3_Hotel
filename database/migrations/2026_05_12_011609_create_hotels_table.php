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
    Schema::create('hotels', function (Blueprint $table) {
        $table->id();
        // foreignId ini untuk menyambungkan ke tabel categories
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        $table->string('name');         // Nama Hotel
        $table->string('image');        // Nama file gambar
        $table->integer('price');       // Harga per malam
        $table->text('description');    // Penjelasan hotel
        $table->string('location');     // Lokasi/Alamat
        $table->double('rating');       // Rating (misal 4.5)
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
