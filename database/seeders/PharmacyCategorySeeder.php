<?php

namespace Database\Seeders;

use App\Models\Pharmacy\Category;
use App\Models\Pharmacy\pharmacyCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PharmacyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pharmacyCategory::updateOrCreate([
            'name' => 'Syrup',
            'slug' => 'syrup'
        ]);

        pharmacyCategory::updateOrCreate([
            'name' => 'Tablet',
            'slug' => 'tablet'
        ]);

        pharmacyCategory::updateOrCreate([
            'name' => 'Inhaler',
            'slug' => 'inhaler'
        ]);
    }
}
