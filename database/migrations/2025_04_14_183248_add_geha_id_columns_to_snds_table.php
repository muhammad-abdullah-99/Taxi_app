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
        Schema::table('snds', function (Blueprint $table) {
            $table->unsignedBigInteger('geha_id')->nullable(); 
            $table->foreign('geha_id')->references('id')->on('gehas')->onDelete('CASCADE');
     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('snds', function (Blueprint $table) {
            //
        });
    }
};
