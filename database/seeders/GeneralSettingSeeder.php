<?php

namespace Database\Seeders;

use App\Models\Setting\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSetting::updateOrCreate([
            'name' => 'Hospital Management',
            'address' => 'Shapla, Rangpur',
            'logo' => 'default.jpg',
            'mobile' => 01000000000,
            'gmail' => 'hospital@gmail.com',
        ]);
    }
}
