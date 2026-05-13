<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        // Relasi ke tabel bookings
        $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
        
        $table->integer('amount');
        $table->string('payment_method');
        $table->string('status')->default('unpaid');
        $table->string('transaction_id')->nullable(); // nullable karena mungkin kosong di awal
        
        $table->timestamps();
    });
}
};
