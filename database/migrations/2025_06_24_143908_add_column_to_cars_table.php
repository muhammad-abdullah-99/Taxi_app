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
        Schema::table('cars', function (Blueprint $table) {
            $table->string('saer_expire_at')->nullable();
            $table->string('tamen_expire_at')->nullable();
            $table->string('fahs_expire_at')->nullable();
            $table->string('cart_expire_at')->nullable();
            $table->string('zaet_expire_at')->nullable();
            $table->string('tafwed_expire_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            //
        });
    }
};
