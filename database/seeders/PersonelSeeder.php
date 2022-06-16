<?php

namespace Database\Seeders;

use App\Models\Personel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create(); 

        for ($i=0; $i < 3; $i++) { 
            Personel::create([
                'user_id' => 1,
                'name' => $faker->name(),
                'departman_id' => rand(1,3),
                'salary' => rand(4500,6000)
            ]);
        }
    }
}
