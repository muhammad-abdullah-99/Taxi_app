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
        Schema::create('snds', function (Blueprint $table) {
            $table->id();
            $table->string('type'); 
            $table->string('client_type')->nullable(); 
            $table->unsignedBigInteger('employee_id')->nullable(); 
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('CASCADE');
            $table->unsignedBigInteger('car_id')->nullable(); 
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('CASCADE');
            $table->string('payment_method')->nullable(); 
            $table->decimal('amount', 10, 2)->nullable(); 
            $table->string('tax')->nullable(); 
            $table->text('description')->nullable(); 
            $table->string('date')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('snds');
    }
};
