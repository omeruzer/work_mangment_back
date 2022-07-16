<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
            Invoice::create([
                'user_id' => 1,
                'type'=>rand(0,1),
                'invoice_no'=>'F-00'.$i+1,
                'customer_id' => rand(1,10),
                'invoice_date'=>Carbon::now()
            ]);
        }
    }
}
