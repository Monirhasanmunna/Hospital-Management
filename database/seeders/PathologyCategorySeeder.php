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
            'name' => 'demo1',
            'slug' => 'demo1'
        ]);

        pathologyCategory::updateOrCreate([
            'name' => 'demo2',
            'slug' => 'demo2'
        ]);

        pathologyCategory::updateOrCreate([
            'name' => 'demo3',
            'slug' => 'demo3'
        ]);
    }
}
