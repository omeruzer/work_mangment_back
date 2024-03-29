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
        for ($i=0; $i < 50; $i++) {
            $int= mt_rand(1644506342,1660155681);

            Invoice::create([
                'user_id' => 1,
                'type'=>rand(0,1),
                'invoice_no'=>'F-00'.$i+1,
                'customer_id' => rand(1,10),
                'invoice_date'=>date("Y-m-d H:i:s",$int)
            ]);
        }
    }
}
