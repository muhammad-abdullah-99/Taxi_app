<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AppUsersConvertUserTypeToStringValues extends Migration
{
    public function up()
    {
        // Direct data update karein
        DB::table('app_users')->update([
            'user_type' => DB::raw('
                CASE 
                    WHEN user_type = "1" THEN "Driver" 
                    WHEN user_type = "2" THEN "Passenger" 
                    WHEN user_type IS NULL THEN "Unknown"
                    WHEN user_type = "" THEN "Unknown"
                    ELSE user_type
                END
            ')
        ]);
    }

    public function down()
    {
        // Rollback - numbers mein convert karein
        DB::table('app_users')->update([
            'user_type' => DB::raw('
                CASE 
                    WHEN user_type = "Driver" THEN "1" 
                    WHEN user_type = "Passenger" THEN "2" 
                    WHEN user_type = "Unknown" THEN NULL
                    ELSE user_type
                END
            ')
        ]);
    }
}