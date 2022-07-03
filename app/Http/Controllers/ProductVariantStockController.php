<?php

namespace App\Http\Controllers;

use App\Models\ProductVariantStock;
use Illuminate\Http\Request;

class ProductVariantStockController extends Controller
{

    public function index(){
        $variantStock = ProductVariantStock::orderByDesc('id')->get();

        return response()->json($variantStock);

    }

    public function add(){
        $variantStock = ProductVariantStock::create([
            'product_id' => request('product_id'),
            'variant_id' => request('variant_id'),
            'variant_value_id' => request('variant_value_id'),
            'stock' => request('stock') ,
        ]);

        return response()->json($variantStock);
    }

    public function edit($id){
        $variantStock = ProductVariantStock::where('id',$id)->update([
            'stock' => request('stock') ,
        ]);

        return response()->json($variantStock);
    }

    public function remove($id){
        $variantStock = ProductVariantStock::where('id',$id)->delete();

        return response()->json($variantStock);
    }
}
