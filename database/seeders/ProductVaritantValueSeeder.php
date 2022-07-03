<?php

namespace Database\Seeders;

use App\Models\ProductVariantValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVaritantValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductVariantValue::create([
            'product_id'=>30,
            'variant_id'=>1,
            'name'=>'Mavi'
        ]);
        ProductVariantValue::create([
            'product_id'=>30,
            'variant_id'=>1,
            'name'=>'Kırmızı'
        ]);
        ProductVariantValue::create([
            'product_id'=>30,
            'variant_id'=>1,
            'name'=>'Mavi'
        ]);
        ProductVariantValue::create([
            'product_id'=>30,
            'variant_id'=>1,
            'name'=>'Sarı'
        ]);
        ProductVariantValue::create([
            'product_id'=>30,
            'variant_id'=>1,
            'name'=>'Beyaz'
        ]);
        ProductVariantValue::create([
            'product_id'=>30,
            'variant_id'=>1,
            'name'=>'Siyah'
        ]);
        ProductVariantValue::create([
            'product_id'=>30,
            'variant_id'=>2,
            'name'=>'S'
        ]);
        ProductVariantValue::create([
            'product_id'=>30,
            'variant_id'=>2,
            'name'=>'M'
        ]);
        ProductVariantValue::create([
            'product_id'=>30,
            'variant_id'=>2,
            'name'=>'L'
        ]);
        ProductVariantValue::create([
            'product_id'=>30,
            'variant_id'=>2,
            'name'=>'XL'
        ]);
        ProductVariantValue::create([
            'product_id'=>30,
            'variant_id'=>2,
            'name'=>'XXL'
        ]);
    }
}
