<?php

namespace Database\Seeders;

use App\Models\Departman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmanSeeder extends Seeder
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
            Departman::create([
                'user_id' => 1,
                'name' => $faker->sentence(1)
            ]);
        }
    }
}
