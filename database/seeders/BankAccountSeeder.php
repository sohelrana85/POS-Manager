<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankAccount::create([
            'user' => '1',
            'bank_name' => 'City Bank Ltd',
            'account_name' => 'Cloud It Digital',
            'account_number' => '1234567890',
            'branch_name' => 'Mirpur 10',
            'status' => '1',
        ]);
        BankAccount::create([
            'user' => '1',
            'bank_name' => 'Dutch Bangla Bank Ltd',
            'account_name' => 'Cloud It Digital',
            'account_number' => '10000200000123',
            'branch_name' => 'Mirpur 12',
            'status' => '1',
        ]);
        BankAccount::create([
            'user' => '1',
            'bank_name' => 'Pubali Bank Ltd',
            'account_name' => 'Cloud It Digital',
            'account_number' => '10234567123',
            'branch_name' => 'Mirpur 12',
            'status' => '1',
        ]);
        BankAccount::create([
            'user' => '1',
            'bank_name' => 'Brack Bank Ltd',
            'account_name' => 'Cloud It Digital',
            'account_number' => '54534554322',
            'branch_name' => 'Mirpur 1',
            'status' => '1',
        ]);
        BankAccount::create([
            'user' => '1',
            'bank_name' => 'Cash Payment',
            'account_name' => 'Cloud It Digital',
            'account_number' => '01721850242',
            'branch_name' => 'Mirpur 1',
            'status' => '1',
        ]);
    }
}
