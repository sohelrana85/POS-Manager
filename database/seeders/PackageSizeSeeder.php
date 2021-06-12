<?php

namespace Database\Seeders;

use App\Models\PackageSize;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PackageSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(File::get(storage_path('jsondata/package_sizes.json')),true);

        foreach ($data as $value) {
            PackageSize::create($value);
        }
    }
}
