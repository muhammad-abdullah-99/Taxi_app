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
        Schema::create('alahda_counts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alahda_id')->nullable(); 
            $table->foreign('alahda_id')->references('id')->on('alahdas')->onDelete('CASCADE');         
            $table->string('serial_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alahda_counts');
    }
};
