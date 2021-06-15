<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([CustomerSeeder::class]);
        $this->call([BrandSeeder::class]);
        $this->call([CategorySeeder::class]);
        $this->call([UnitTypeSeeder::class]);
        $this->call([PackageSizeSeeder::class]);
        $this->call([BankAccountSeeder::class]);
        $this->call([PurchaseStatusSeeder::class]);
        $this->call([PaymentTypeSeeder::class]);
        $this->call([PaymentStatusSeeder::class]);
        $this->call([WarehouseSeeder::class]);
        $this->call([ExpenseTypeSeeder::class]);
    }
}
