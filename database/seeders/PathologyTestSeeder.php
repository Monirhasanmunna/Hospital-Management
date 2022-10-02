<?php

namespace Database\Seeders;

use App\Models\Pathology\pathologyTest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PathologyTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pathologyTest::updateOrCreate([
            'category_id'          => 1,
            'code'                 => 1001,
            'name'                 => 'Blood detection',
            'standard_rate'        => 1400,
            'refd_percent'         => 10,
            'refd_amount'          => 140
        ]);

        pathologyTest::updateOrCreate([
            'category_id'          => 2,
            'code'                 => 1002,
            'name'                 => 'Medical Microbiology',
            'standard_rate'        => 2000,
            'refd_percent'         => 8,
            'refd_amount'          => 160
        ]);

        pathologyTest::updateOrCreate([
            'category_id'          => 3,
            'code'                 => 1003,
            'name'                 => 'CT scan',
            'standard_rate'        => 1000,
            'refd_percent'         => 5,
            'refd_amount'          => 50
        ]);

        pathologyTest::updateOrCreate([
            'category_id'          => 3,
            'code'                 => 1004,
            'name'                 => 'MRI',
            'standard_rate'        => 1400,
            'refd_percent'         => 15,
            'refd_amount'          => 210
        ]);
    }
}
