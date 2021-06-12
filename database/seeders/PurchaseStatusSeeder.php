<?php

namespace Database\Seeders;

use App\Models\PurchaseStatus;
use Illuminate\Database\Seeder;

class PurchaseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurchaseStatus::create([
            'user' => '1',
            'name' => 'Received',
        ]);
        PurchaseStatus::create([
            'user' => '1',
            'name' => 'Partial',
        ]);
        PurchaseStatus::create([
            'user' => '1',
            'name' => 'Pending',
        ]);
        PurchaseStatus::create([
            'user' => '1',
            'name' => 'Ordered',
        ]);
    }
}
