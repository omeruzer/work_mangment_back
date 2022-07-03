<?php

namespace App\Http\Controllers;

use App\Models\ProductVariantValue;
use Illuminate\Http\Request;

class ProductVariantValueController extends Controller
{



    public function index(){
        $variantValue = ProductVariantValue::orderByDesc('id')->get();

        return response()->json($variantValue);

    }

    public function add(){
        $variantValue = ProductVariantValue::create([
            'product_id' => request('product_id'),
            'variant_id' => request('variant_id'),
            'name' => request('name') ,
        ]);

        return response()->json($variantValue);
    }

    public function edit($id){
        $variantValue = ProductVariantValue::where('id',$id)->update([
            'name' => request('name') ,
        ]);

        return response()->json($variantValue);
    }

    public function remove($id){
        $variantValue = ProductVariantValue::where('id',$id)->delete();

        return response()->json($variantValue);
    }
}
