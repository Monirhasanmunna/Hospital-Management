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
        Account::updateOrcreate([
            'name'      => 'Patient Service',
            'debit'     => 0,
            'credit'    => 0,
            'balance'   => 0
        ]);
    }
}
