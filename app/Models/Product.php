<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table ='products';
    protected $guarded = [];

    protected $appends=[
        'sellCount',
        'totalSellPrice',
        'totalSellProfit'
    ];

    public function getsellCountAttribute(){
        $sellCount=0;
        $invoice =Invoice::with('getDetail')->where('type',1)->get();

        foreach ($invoice as  $value) {
            foreach ($value->getDetail->where('product_id',$this->id)  as $item) {
                $sellCount=$sellCount+($item->qty);
            }    
        }
         
        return $sellCount;
    }

    public function gettotalSellPriceAttribute(){
        $sellPrice=0;
        $invoice =Invoice::with('getDetail')->where('type',1)->get();

        foreach ($invoice as  $value) {
            foreach ($value->getDetail->where('product_id',$this->id)  as $item) {
                $sellPrice=$sellPrice+($item->price*$item->qty);
            }    
        }
         
        return $sellPrice;
    }

    public function gettotalSellProfitAttribute(){
        
        $cors=$this->cors;
        $totalPrice = $this->gettotalSellPriceAttribute();
        $sellCount = $this->getsellCountAttribute();
        
        $total=$totalPrice-($cors*$sellCount);

        return $total;
    }

    public function getBrand(){
        return $this->hasOne('App\Models\Brand','id','brand_id');
    }
    public function getCategory(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }

    public function getMaterial(){
        return $this->hasOne('App\Models\Material','id','material_id');
    }

    public function getPattern(){
        return $this->hasOne('App\Models\Pattern','id','pattern_id');
    }

    public function getSeason(){
        return $this->hasOne('App\Models\Season','id','season_id');
    }

    public function getProductVariant(){
        return $this->hasMany('App\Models\ProductVariant','product_id');
    }
}
