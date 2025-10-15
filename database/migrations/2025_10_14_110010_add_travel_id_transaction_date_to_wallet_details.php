<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('wallet_details', function (Blueprint $table) {
            // travel_id column add karo (agar exist nahi karta)
            if (!Schema::hasColumn('wallet_details', 'travel_id')) {
                $table->unsignedBigInteger('travel_id')->nullable()->after('updated_at');
                
                // Foreign key constraint add karo
                $table->foreign('travel_id')
                      ->references('id')
                      ->on('travel')
                      ->onDelete('cascade');
            }
            
            // transaction_date column add karo (agar exist nahi karta)
            if (!Schema::hasColumn('wallet_details', 'transaction_date')) {
                $table->date('transaction_date')->nullable()->after('travel_id');
            }
        });
    }

    public function down()
    {
        Schema::table('wallet_details', function (Blueprint $table) {
            // Pehle foreign key constraint drop karo
            if (Schema::hasColumn('wallet_details', 'travel_id')) {
                $table->dropForeign(['travel_id']);
                $table->dropColumn('travel_id');
            }
            
            // transaction_date column drop karo
            if (Schema::hasColumn('wallet_details', 'transaction_date')) {
                $table->dropColumn('transaction_date');
            }
        });
    }
};