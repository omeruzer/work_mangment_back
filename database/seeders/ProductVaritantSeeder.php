<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVaritantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            ProductVariant::create([
                'product_id'=>30,
                'name'=>'Renk'
            ]);
            ProductVariant::create([
                'product_id'=>30,
                'name'=>'Beden'
            ]);
    }
}
