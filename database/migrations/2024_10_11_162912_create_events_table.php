<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('venue');
            $table->date('date');
            $table->time('start_time');
            $table->text('description')->nullable();
            $table->string('booking_url')->nullable();
            $table->string('tags')->nullable();
            
            $table->foreignId('organizer_id')->constrained('organizers')->onDelete('cascade');
            
            $table->foreignId('event_category_id')->constrained('event_categories')->onDelete('cascade');
            
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
