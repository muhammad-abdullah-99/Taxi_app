<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('travel', function (Blueprint $table) {
            $table->boolean('round_trip')
                  ->default(false)
                  ->after('between_city_id'); // optional: position specify karein
        });
    }

    public function down(): void
    {
        Schema::table('travel', function (Blueprint $table) {
            $table->dropColumn('round_trip');
        });
    }
};