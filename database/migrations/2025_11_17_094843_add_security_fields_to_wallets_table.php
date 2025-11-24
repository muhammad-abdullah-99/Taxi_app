<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->boolean('is_locked')->default(false)->after('current_balance');
            $table->timestamp('locked_at')->nullable()->after('is_locked');
            $table->string('locked_reason')->nullable()->after('locked_at');
            $table->integer('failed_attempts')->default(0)->after('locked_reason');
            $table->decimal('daily_limit', 10, 2)->default(10000)->after('failed_attempts');
            $table->decimal('daily_spent', 10, 2)->default(0)->after('daily_limit');
            $table->date('daily_reset_date')->nullable()->after('daily_spent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn([
                'is_locked', 'locked_at', 'locked_reason',
                'failed_attempts', 'daily_limit', 'daily_spent', 'daily_reset_date'
            ]);
        });
    }
};
