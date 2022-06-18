<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
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
            Note::create([
                'user_id' => 1,
                'title' => $faker->sentence(1),
                'content' => $faker->sentence(5)
            ]);
        }
    }
}
