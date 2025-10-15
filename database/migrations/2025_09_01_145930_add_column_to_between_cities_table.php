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
        Schema::table('between_cities', function (Blueprint $table) {
            $table->string('car_type')->nullable(); //  (اختياري)
            $table->string('code')->nullable(); //  (اختياري)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('between_cities', function (Blueprint $table) {
            //
        });
    }
};
