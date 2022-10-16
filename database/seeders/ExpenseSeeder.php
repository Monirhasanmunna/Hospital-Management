<?php

namespace Database\Seeders;

use App\Models\Expense\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expense::updateOrCreate([
            'category_id'=> 1,
            'date'=> date('Y-m-d'),
            'amount'=> 5000,
            'details'=> 'this amount expense to TDTA perpose',
        ]);
    }
}
