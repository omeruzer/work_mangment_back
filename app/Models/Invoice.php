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
        'amount'
    ];

    public function getCustomer(){
        return $this->hasOne('App\Models\Customer','id','customer_id');
    }

    public function getDetail(){
        return $this->hasMany('App\Models\InvoiceProducts','invoice_id');
    }

    public function getAmountAttribute(){
        $amount = $this->getDetail->sum('price');

        return $amount;
    }

}
