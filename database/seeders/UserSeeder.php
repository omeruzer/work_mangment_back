<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ömer Uzer',
            'email'=> 'omeruzer@gmail.com',
            'isActive'=> 1,
            'password' => Hash::make('asd'),
            'shop_name' => 'Ömerin Mağazası',
            'shop_address' => 'Zeytinburnu İstanbul',
            'phone'=> 05645646645
        ]);
    }
}
