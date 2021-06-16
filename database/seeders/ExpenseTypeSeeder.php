<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(File::get(storage_path('jsondata/expense_types.json')),true);
        foreach ($data as $value) {
            ExpenseType::create($value);
        }
    }
}
