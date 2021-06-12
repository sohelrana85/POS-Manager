<?php

namespace Database\Seeders;

use App\Models\UnitType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(File::get(storage_path('jsondata/unit_types.json')),true);

        foreach ($data as $value) {
            UnitType::create($value);
        }

    }
}
