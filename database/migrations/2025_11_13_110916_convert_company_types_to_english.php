<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $mapping = [
            'الاجرة العامة' => 'publicFare',
            'الأجرة العامة' => 'publicFare',
            'الاجرة الخاصة' => 'privateFare',
            'الأجرة الخاصة' => 'privateFare',
            'النقل المتخصص' => 'specializedTransport',
            'السيارات الخاصة للمقيمين' => 'privateCarsResidents',
            'سيارات خاصة للمقيمين' => 'privateCarsResidents',
            'السيارات الخاصة للمواطنين' => 'privateCarsCitizens',
            'سيارات خاصة للمواطنين' => 'privateCarsCitizens',
        ];

        // Update companies table
        foreach ($mapping as $arabic => $english) {
            DB::table('companies')
                ->where('company_type', $arabic)
                ->update(['company_type' => $english]);
        }

        // Update between_cities table
        foreach ($mapping as $arabic => $english) {
            DB::table('between_cities')
                ->where('company_type', $arabic)
                ->update(['company_type' => $english]);
        }
    }

    public function down(): void
    {
        // Reverse if needed
    }
};