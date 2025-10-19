<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('station_wallets', function (Blueprint $table) {
            if (!Schema::hasColumn('station_wallets', 'payment_status')) {
                $table->string('payment_status', 255)->nullable()->after('updated_at');
            }
        });
    }

    public function down()
    {
        Schema::table('station_wallets', function (Blueprint $table) {
            // Safe dropping - check karo pehle ke column exist karta hai
            if (Schema::hasColumn('station_wallets', 'payment_status')) {
                $table->dropColumn('payment_status');
            }
        });
    }
};