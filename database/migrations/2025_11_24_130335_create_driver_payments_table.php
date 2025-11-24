<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('driver_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->unique()->index();
            $table->foreignId('travel_id')->constrained('travel')->cascadeOnDelete();
            $table->foreignId('driver_id')->constrained('app_users')->cascadeOnDelete();
            $table->foreignId('passenger_id')->nullable()->constrained('app_users')->nullOnDelete();
            $table->decimal('trip_amount', 10, 2); // Total trip amount
            $table->decimal('operating_fee', 10, 2)->default(50); // 50 SAR fee
            $table->decimal('driver_amount', 10, 2); // Amount driver receives
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->foreignId('marked_by')->nullable()->constrained('users')->nullOnDelete(); // Admin who marked paid
            $table->timestamp('trip_completed_at');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['driver_id', 'status']);
            $table->index(['status', 'trip_completed_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('driver_payments');
    }
};