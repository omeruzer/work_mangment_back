<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table ='product_variants';
    protected $guarded = [];

    public function getProductVariantValue()
    {
        return $this->hasMany('App\Models\ProductVariantValue','variant_id');
    }
}
