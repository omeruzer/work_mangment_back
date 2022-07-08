<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table ='customers';
    protected $guarded = [];

    protected $appends=[
        'orderCount',
    ];

    public function getorderCountAttribute(){
        $data = Invoice::where('customer_id',$this->id)
        ->where('type',1)
        ->where('created_at','<=',Carbon::now()->modify('last day of this month'))
        ->where('created_at','>=',Carbon::now()->modify('first day of this month'))
        ->count();

        return  $data;
    }

    public function getOrders(){
        return $this->hasMany('App\Models\Invoice','customer_id');
    }
}
