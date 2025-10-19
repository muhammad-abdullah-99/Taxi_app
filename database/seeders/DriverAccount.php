<?php

namespace Database\Seeders;

use App\Models\AppUser;
use Illuminate\Database\Seeder;

class DriverAccount extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppUser::firstOrCreate(['id_number' => 'guest'], $this->guestDriverData());
        AppUser::firstOrCreate(['id_number' => '12345678'], $this->islamDriverData());
        AppUser::firstOrCreate(['id_number' => '12345677'], $this->ahmedDriverData());
    }

    private function guestDriverData()
    {
        return [
            'name' => 'guest',
            'mobile' => 'guest',
            'id_number' => 'guest',
            'user_type' => 1,
            'status' => 1,
        ];
    }

    private function islamDriverData()
    {
        return [
            'name' => 'islam',
            'mobile' => '0512345678',
            'id_number' => '12345678', // أو أي قيمة مناسبة
            'user_type' => 1,
            'status' => 1,
        ];
    }
    private function ahmedDriverData()
    {
        return [
            'name' => 'ahmed',
            'mobile' => '0512345677',
            'id_number' => '12345677', // أو أي قيمة مناسبة
            'user_type' => 1,
            'status' => 0,
        ];
    }
}
