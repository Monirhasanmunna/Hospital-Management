<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'name'=> 'Hospital Management',
            'logo'=> 'default.jpg',
            'address'=> 'Shapla Ranpgur',
            'gmail'=> 'hospital@gmail.com',
            'mobile'=> 01000000000,
        ]);
    }
}
