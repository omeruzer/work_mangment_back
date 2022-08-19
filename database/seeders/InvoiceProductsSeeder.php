<?php

namespace Database\Seeders;

use App\Models\InvoiceProducts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 50; $i++) {
            InvoiceProducts::create([
                'invoice_id' => rand(1,50),
                'product_id'=>rand(1,30),
                'qty' => rand(1,10),
                'price' => rand(30,100)
            ]);
        }
    }
}
