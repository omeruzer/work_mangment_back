<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internel extends Model
{
    use HasFactory;

    protected $table ='internels';
    protected $guarded = [];


    protected $appends=[
        'productQty'
    ];

    public function getproductQtyAttribute(){
        $qty =0;

        foreach ($this->getDetail as $value) {
            $qty=$qty+($value->qty);
        }

        return $qty;
    }

    public function getDetail(){
        return $this->hasMany('App\Models\InternelProduct','internel_id');
    }
}
