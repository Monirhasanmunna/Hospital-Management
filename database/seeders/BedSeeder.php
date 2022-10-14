<?php

namespace Database\Seeders;

use App\Models\Bed\Bed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bed::updateOrCreate([
            'bedtype_id'    => 1,
            'bedgroup_id'   => 2,
            'name'          => 'GF - 101',
            'status'        => true,
        ]);

        Bed::updateOrCreate([
            'bedtype_id'    => 2,
            'bedgroup_id'   => 1,
            'name'          => 'TF - 102',
        ]);

        Bed::updateOrCreate([
            'bedtype_id'    => 3,
            'bedgroup_id'   => 3,
            'name'          => 'SF - 105',
        ]);
    }
}
