<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductVariantController extends Controller
{

    public function index(){
        $variant = ProductVariant::with('getProductVariantValue.getProductVariantStock')->orderByDesc('id')->get();

        return response()->json($variant);

    }

    public function add(){
        $variant = ProductVariant::create([
            'product_id' => request('product_id'),
            'name' => request('name') ,
        ]);

        return response()->json($variant);
    }

    public function edit($id){
        $variant = ProductVariant::where('id',$id)->update([
            'name' => request('name') ,
        ]);

        return response()->json($variant);
    }

    public function remove($id){
        $variant = ProductVariant::where('id',$id)->delete();

        return response()->json($variant);
    }

}

