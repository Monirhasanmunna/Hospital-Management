<?php

namespace Database\Seeders;

use App\Models\Expense\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpenseCategory::updateOrCreate([
            'code'      => 4837,
            'name'     => 'HRM'
        ]);
    }
}
