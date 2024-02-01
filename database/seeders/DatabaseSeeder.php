<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Building;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'username' => 'suadmin',
            'whatsapp_no' => '081390343421',
            'password' => 'password',
            'admin_status' => 2
        ]);

        for ($i=1; $i <= 4; $i++) {
            Building::create([
                'name' => "Gedung A Lantai " . $i
            ]);
        }

        for ($i=2; $i <= 4; $i++) {
            Building::create([
                'name' => "Gedung B Lantai " . $i
            ]);
        }

        for ($i = 1; $i <= 12; $i++) {
            Room::create([
                'name' => 'RA1.0' . $i,
                'building_id' => 1
            ]);
        }

        for ($i = 1; $i <= 12; $i++) {
            Room::create([
                'name' => 'RA2.0' . $i,
                'building_id' => 2
            ]);
        }

        for ($i = 1; $i <= 12; $i++) {
            Room::create([
                'name' => 'RA3.0' . $i,
                'building_id' => 3
            ]);
        }

        for ($i = 1; $i <= 12; $i++) {
            Room::create([
                'name' => 'RA4.0' . $i,
                'building_id' => 4
            ]);
        }

        for ($i = 1; $i <= 12; $i++) {
            Room::create([
                'name' => 'RB2.0' . $i,
                'building_id' => 5
            ]);
        }

        for ($i = 1; $i <= 12; $i++) {
            Room::create([
                'name' => 'RB3.0' . $i,
                'building_id' => 6
            ]);
        }

        for ($i = 1; $i <= 12; $i++) {
            Room::create([
                'name' => 'RB4.0' . $i,
                'building_id' => 7
            ]);
        }
    }
}
