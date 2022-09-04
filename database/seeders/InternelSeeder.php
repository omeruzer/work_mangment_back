<?php

namespace Database\Seeders;

use App\Models\Internel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
            $int= mt_rand(1644506342,1660155681);

            Internel::create([
                'user_id' => 1,
                'type'=>rand(0,1),
                'internel_no'=>'D-00'.$i+1,
                'internel_date'=>date("Y-m-d H:i:s",$int)
            ]);
        }
    }
}
