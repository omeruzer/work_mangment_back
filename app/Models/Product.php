<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table ='products';
    protected $guarded = [];

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
}
