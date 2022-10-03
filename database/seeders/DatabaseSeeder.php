<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Pharmacy\CategorySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PharmacyCategorySeeder::class);
        $this->call(PharmacySupplierSeeder::class);

        $this->call(PathologyCategorySeeder::class);
        $this->call(PathologyUnitSeeder::class);
        $this->call(PathologyTestSeeder::class);
        $this->call(PathologyDoctorSeeder::class);
        $this->call(PathologyReferralSeeder::class);
    }
}
