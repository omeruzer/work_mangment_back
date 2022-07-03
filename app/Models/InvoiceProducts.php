<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProducts extends Model
{
    use HasFactory;

    protected $table ='invoice_products';
    protected $guarded = [];

    public function getProduct(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }


}
