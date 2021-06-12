<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::create([
            'user_id' => '1',
            'name' => 'Cash',
            'status' => '1',
        ]);
        PaymentType::create([
            'user_id' => '1',
            'name' => 'Bank Account',
            'status' => '1',
        ]);
        PaymentType::create([
            'user_id' => '1',
            'name' => 'Cheque',
            'status' => '1',
        ]);
        PaymentType::create([
            'user_id' => '1',
            'name' => 'Mobile Banking',
            'status' => '1',
        ]);
    }
}
