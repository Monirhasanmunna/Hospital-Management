<?php

namespace Database\Seeders;

use App\Models\Bed\BedGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BedGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BedGroup::updateOrCreate([
            'floor_id'      => 1,
            'name'          => 'VIP Ward',
            'description'   => 'A palliative or hospice unit is where end-of-life care is provided if you have a life-limiting illness, which may or may not be cancer-related. Hospice and palliative care focus on providing comfort a'
        ]);

        BedGroup::updateOrCreate([
            'floor_id'      => 2,
            'name'          => 'Private Ward',
            'description'   => 'The operating room (OR) is where both inpatient and outpatient surgeries are performed.'
        ]);

        BedGroup::updateOrCreate([
            'floor_id'      => 3,
            'name'          => 'General Ward',
        ]);
    }
}
