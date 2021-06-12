<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create([
            'user' =>'1',
            'name' =>'Warehouse 1',
        ]);
        Warehouse::create([
            'user' =>'1',
            'name' =>'Warehouse 2',
        ]);
        Warehouse::create([
            'user' =>'1',
            'name' =>'Warehouse 3',
        ]);
        Warehouse::create([
            'user' =>'1',
            'name' =>'Warehouse 4',
        ]);
        Warehouse::create([
            'user' =>'1',
            'name' =>'Warehouse 5',
        ]);
    }
}
