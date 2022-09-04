<?php

namespace Database\Seeders;

use App\Models\InternelProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternelProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 50; $i++) {
            InternelProduct::create([
                'internel_id' => rand(1,10),
                'product_id'=>rand(1,30),
                'qty' => rand(1,10),
            ]);
        }
    }
}
