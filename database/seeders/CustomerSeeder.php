<?php

namespace Database\Seeders;

use App\Models\Customer;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = Factory::create();

        foreach (range(1,30) as $value) {
            Customer::create([
                'user_id' => 1,
                'name'    => $faker->name,
                'email'   => $faker->unique()->email,
                'phone'   => '017'.rand(11111111,99999999),
                'address' => $faker->address,
                'status'  => rand(0,1),
            ]);
        }
    }
}
