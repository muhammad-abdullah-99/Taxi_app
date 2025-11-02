<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDriverAssignedAtAndCancelledAtToTravelsTable extends Migration
{
    public function up()
    {
        Schema::table('travel', function (Blueprint $table) {
            $table->timestamp('driver_assigned_at')->nullable()->after('ended_at');
            $table->timestamp('cancelled_at')->nullable()->after('driver_assigned_at');
        });
    }

    public function down()
    {
        Schema::table('travel', function (Blueprint $table) {
            $table->dropColumn(['driver_assigned_at', 'cancelled_at']);
        });
    }
}