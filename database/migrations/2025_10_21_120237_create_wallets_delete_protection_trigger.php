<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateWalletsDeleteProtectionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER prevent_wallets_delete
            BEFORE DELETE ON wallets
            FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE '45000' 
                SET MESSAGE_TEXT = 'DELETE operation is blocked on wallets table for safety';
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_wallets_delete');
    }
}