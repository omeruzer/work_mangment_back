<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternelProduct extends Model
{
    use HasFactory;

    protected $table ='internel_products';
    protected $guarded = [];

    public function getProduct(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }
    public function getInternel(){
        return $this->hasOne('App\Models\Internel','id','internel_id');
    }
}
