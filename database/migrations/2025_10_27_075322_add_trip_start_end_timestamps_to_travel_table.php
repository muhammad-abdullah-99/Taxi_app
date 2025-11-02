<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel', function (Blueprint $table) {
            // Add trip tracking timestamps
            $table->timestamp('started_at')->nullable()->after('round_trip')->comment('Trip start time');
            $table->timestamp('ended_at')->nullable()->after('started_at')->comment('Trip end time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel', function (Blueprint $table) {
            $table->dropColumn(['started_at', 'ended_at']);
        });
    }
};