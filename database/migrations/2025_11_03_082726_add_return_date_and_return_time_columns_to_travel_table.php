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
        Schema::table('travel', function (Blueprint $table) {
            $table->string('return_date', 255)->nullable()->after('time');
            $table->string('return_time', 255)->nullable()->after('return_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel', function (Blueprint $table) {
            $table->dropColumn(['return_date', 'return_time']);
        });
    }
};