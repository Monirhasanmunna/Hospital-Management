<?php

namespace Database\Seeders;

use App\Models\Pathology\pathologyDoctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PathologyDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pathologyDoctor::updateOrCreate([
            'name'  => 'Dr. Shakil Ahmed',
            'title' => 'Anaesthetist'
        ]);

        pathologyDoctor::updateOrCreate([
            'name'  => 'Dr. Sakib Hosen',
            'title' => 'Forensic physician'
        ]);

        pathologyDoctor::updateOrCreate([
            'name'  => 'Dr. Shamoly Akter',
            'title' => 'Gynaecologist'
        ]);
    }
}
