<?php

namespace Database\Seeders;

use App\Models\Bed\Floor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Floor::updateOrCreate([
            'name'          => 'Ground Floor',
            'description'   =>  'A good choice here would be luxury vinyl tile (LVT), vinyl composition tile (VCT), sheet vinyl, rubber, or linoleum.',
        ]);

        Floor::updateOrCreate([
            'name'          => '1st Floor',
            'description'   =>  'Neonatal intensive care units (NICUs) which provide care for newborn infants.',
        ]);

        Floor::updateOrCreate([
            'name'          => '2nd Floor',
            'description'   =>  '	The pediatric intensive care unit (PICU) where children receive critical care. Depending on the facility, newborns may be treated in a PICU or a neonatal ICU. Smaller facilities may have a PICU only, while larger facilities may offer both a PICU and a neonatal ICU.',
        ]);
    }
}
