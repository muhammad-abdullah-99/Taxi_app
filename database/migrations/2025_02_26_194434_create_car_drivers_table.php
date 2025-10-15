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
        Schema::create('car_drivers', function (Blueprint $table) {
            $table->id();
            $table->string('handover_date')->nullable(); // تاريخ الاستلام
            $table->decimal('initial_meter_reading')->nullable(); // رقم العداد عند الاستلام
            $table->string('return_date')->nullable(); // تاريخ التسليم
            $table->decimal('final_meter_reading')->nullable(); // رقم العداد الجديد عند التسليم
            $table->unsignedBigInteger('car_id')->nullable(); 
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('CASCADE');
            $table->unsignedBigInteger('employee_id')->nullable(); 
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_drivers');
    }
};
