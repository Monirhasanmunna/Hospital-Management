<?php

namespace Database\Seeders;

use App\Models\Pathology\pathologyReferral;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PathologyReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pathologyReferral::updateOrCreate([
            'code'   => 1000,
            'name'   => 'Ashraf',
            'mobile' => '01745121475'
        ]);

        pathologyReferral::updateOrCreate([
            'code'   => 1001,
            'name'   => 'Tarazul',
            'mobile' => '01751214575'
        ]);

        pathologyReferral::updateOrCreate([
            'code'   => 1002,
            'name'   => 'Tarek',
            'mobile' => '01457512475'
        ]);
    }
}
