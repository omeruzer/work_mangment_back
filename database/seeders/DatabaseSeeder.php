<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Prophecy\Call\Call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(DepartmanSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(PatternSeeder::class);
        $this->call(PersonelSeeder::class);
        $this->call(SeasonSeeder::class);
        $this->call(NoteSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ProductVaritantSeeder::class);
        $this->call(ProductVaritantValueSeeder::class);
        $this->call(ProductVariantStockSeeder::class);
        $this->call(InvoiceSeeder::class);
        $this->call(InvoiceProductsSeeder::class);
    }
}
