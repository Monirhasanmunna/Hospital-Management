<?php

namespace Database\Seeders;

use App\Models\Expense\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::updateOrCreate([
            'name'      => 'Admin',
            'debit'     => 0,
            'credit'    =>  50000,
            'balance'    =>  50000,
        ]);
    }
}
