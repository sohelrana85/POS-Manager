<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentStatus::create([
            'user' => '1',
            'name' => 'Paid',
        ]);
        PaymentStatus::create([
            'user' => '1',
            'name' => 'Partial',
        ]);
        PaymentStatus::create([
            'user' => '1',
            'name' => 'Due',
        ]);
    }
}
