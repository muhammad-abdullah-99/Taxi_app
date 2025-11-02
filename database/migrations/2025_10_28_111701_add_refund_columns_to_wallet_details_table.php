<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefundColumnsToWalletDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('wallet_details', function (Blueprint $table) {
            $table->decimal('refund_amount', 10, 2)->nullable()->after('amount');
            $table->decimal('deduction_amount', 10, 2)->nullable()->after('refund_amount');
            $table->decimal('refund_percentage', 5, 2)->nullable()->after('deduction_amount');
        });
    }

    public function down()
    {
        Schema::table('wallet_details', function (Blueprint $table) {
            $table->dropColumn(['refund_amount', 'deduction_amount', 'refund_percentage']);
        });
    }
}