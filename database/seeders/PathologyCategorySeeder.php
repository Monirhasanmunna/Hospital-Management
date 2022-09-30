<?php

namespace Database\Seeders;

use App\Models\Pathology\pathologyCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PathologyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pathologyCategory::updateOrCreate([
            'name' => 'Forensic pathology',
            'slug' => 'forensic pathology'
        ]);

        pathologyCategory::updateOrCreate([
            'name' => 'Histopathology',
            'slug' => 'histopathology'
        ]);

        pathologyCategory::updateOrCreate([
            'name' => 'Neuropathology',
            'slug' => 'neuropathology'
        ]);
    }
}
