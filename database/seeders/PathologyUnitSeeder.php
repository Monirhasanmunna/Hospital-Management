<?php

namespace Database\Seeders;

use App\Models\Pathology\pathologyUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PathologyUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pathologyUnit::updateOrCreate([
            'name'  => 'Pic',
            'slug'  => 'pic'
        ]);

        pathologyUnit::updateOrCreate([
            'name'  => 'Kg',
            'slug'  => 'kg'
        ]);

        pathologyUnit::updateOrCreate([
            'name'  => 'Dozen',
            'slug'  => 'dozen'
        ]);

        pathologyUnit::updateOrCreate([
            'name'  => 'Litter',
            'slug'  => 'litter'
        ]);
    }
}
