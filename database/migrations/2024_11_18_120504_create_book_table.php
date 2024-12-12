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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('alamat');
            $table->string('nomor_hp');
            $table->string('status_bayar')->default('unpaid');
            $table->string('transaction_id')->nullable();
            // Add the 'id_event' column before referencing it
            $table->unsignedBigInteger('id_event'); 

            // Define the foreign key constraint
            $table->foreign('id_event')->references('id')->on('events')->onDelete('cascade'); 
                  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};