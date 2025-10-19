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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('app_user_id')->nullable();
            $table->foreign('app_user_id')->references('id')->on('app_users')->onDelete('CASCADE');
            $table->string('status')->nullable(); //  (اختياري)
            $table->string('image')->nullable(); //  (اختياري)
            $table->string('text')->nullable(); //  (اختياري)
            $table->string('otp')->nullable(); //  (اختياري)
                   $table->timestamp('otp_expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
