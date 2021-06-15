<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(public_path(storage_path('jsondata/expense_types.json')),true);
        foreach ($data as $value) {
            ExpenseType::create($value);
        }
    }
}
