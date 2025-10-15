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
        Schema::create('passenger_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('id_number')->nullable();
            $table->string('Gender')->nullable();
            $table->string('phone_number')->nullable();
            $table->unsignedBigInteger('passenger_id')->nullable(); 
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('CASCADE');         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passenger_lists');
    }
};
