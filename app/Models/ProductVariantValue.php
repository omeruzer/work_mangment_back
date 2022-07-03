<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantValue extends Model
{
    use HasFactory;

    protected $table ='product_variant_values';
    protected $guarded = [];

    public function getProductVariantStock()
    {
        return $this->hasOne('App\Models\ProductVariantStock','variant_value_id');
    }
}
