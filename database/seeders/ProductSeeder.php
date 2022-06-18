<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create(); 

        for ($i=0; $i < 30; $i++) { 
            Product::create([
                'user_id' => 1,
                'name' => $faker->sentence(2),
                'code' => rand(2000,99999),
                'price' => $faker->randomFloat(3,1,500),
                "qty"=> rand(500,5000),
                "packQty"=> 1,
                'sizes'=>'S-M-L-XL-XXL',
                'content'=>$faker->sentence(6),
                'category_id' => rand(1,5),
                'pattern_id' => rand(1,3),
                'material_id' => rand(1,3),
                'brand_id' => rand(1,3),
                'season_id' => rand(1,3),                
            ]);
        }
    }
}
