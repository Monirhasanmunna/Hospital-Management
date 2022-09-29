<?php

namespace Database\Seeders;

use App\Models\Pharmacy\pharmacySupplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PharmacySupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pharmacySupplier::updateOrCreate([
            'name'  => 'Pharmaceutical Warehouse',
            'slug'  => 'pharmaceutical warehouse',
            'code'  => 'p-30'
        ]);

        pharmacySupplier::updateOrCreate([
            'name'  => 'Johnson & Johnson',
            'slug'  => 'johnson & johnson',
            'code'  => 'jo-40'
        ]);
    }
}
