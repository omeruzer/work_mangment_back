<?php

namespace Database\Seeders;

use App\Models\Current;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 50; $i++) {
            $faker = \Faker\Factory::create();
            $int= mt_rand(1644506342,1660155681);
            Current::create([
                'user_id' => 1,
                'type'=>rand(0,1),
                'title'=>$faker->sentence(1),
                'desc'=>$faker->sentence(5),
                'price'=>rand(150,5000),
                'current_date'=>date("Y-m-d H:i:s",$int)
            ]);
        }
    }
}
