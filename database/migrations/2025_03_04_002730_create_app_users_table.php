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
        Schema::create('app_users', function (Blueprint $table) {
            $table->id(); // معرف المستخدم الأساسي
            $table->string('name');
            // $table->string('name_ar')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->string('mobile')->unique();
            $table->string('user_type')->nullable();
            // $table->enum('user_type', ['admin', 'driver', 'customer'])->default('customer'); 
            $table->string('id_image')->nullable();
            $table->string('id_number')->unique()->nullable();
            $table->string('license_image_url')->nullable();
            $table->string('status')->nullable(); //active //not active
            // $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('otp')->nullable();
            // $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('driving_license')->nullable();
            // $table->foreignId('bank_id')->nullable()->constrained('banks')->nullOnDelete();
            $table->string('bank_account')->nullable();
            $table->string('device_token')->nullable();
            $table->string('otp_expires_at')->nullable();
            // $table->boolean('is_available')->default(false);
            $table->string('driver_image')->nullable();
            $table->string('city')->nullable();
            // $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_users');
    }
};
