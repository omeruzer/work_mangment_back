<?php

namespace Database\Seeders;

use App\Models\ProductVariantStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 6 ; $i++) { 
            ProductVariantStock::create([
                'product_id'=>30,
                'variant_id'=>1,
                'variant_value_id'=>$i+1,
                'stock' => rand(2,50)
            ]);
        }

        for ($i=0; $i < 5 ; $i++) { 
            ProductVariantStock::create([
                'product_id'=>30,
                'variant_id'=>2,
                'variant_value_id'=>$i+1,
                'stock' => rand(2,50)
            ]);
        }


    }
}
