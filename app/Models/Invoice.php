<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory;

    protected $table ='invoices';
    protected $guarded = [];

    protected $appends=[
        'amount',
        'productQty'
    ];

    public function getCustomer(){
        return $this->hasOne('App\Models\Customer','id','customer_id');
    }

    public function getDetail(){
        return $this->hasMany('App\Models\InvoiceProducts','invoice_id');
    }

    public function getAmountAttribute(){
        $amount =0;

        foreach ($this->getDetail as $value) {
            $amount=$amount+($value->price*$value->qty);
        }

        Invoice::where('id',$this->id)->update(['amount_db'=>$amount]);

        return $amount;
    }
    public function getproductQtyAttribute(){
        $qty =0;

        foreach ($this->getDetail as $value) {
            $qty=$qty+($value->qty);
        }

        return $qty;
    }

}
