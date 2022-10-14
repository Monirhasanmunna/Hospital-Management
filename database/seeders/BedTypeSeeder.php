<?php

namespace Database\Seeders;

use App\Models\Bed\BedType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BedTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BedType::updateOrCreate([
            'name'  => 'Standard'
        ]);

        BedType::updateOrCreate([
            'name'  => 'VIP'
        ]);

        BedType::updateOrCreate([
            'name'  => 'Normal'
        ]);
    }
}
