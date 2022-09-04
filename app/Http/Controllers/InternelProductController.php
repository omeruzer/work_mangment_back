<?php

namespace App\Http\Controllers;

use App\Models\InternelProduct;
use App\Models\Product;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class InternelProductController extends Controller
{
    public function index(){
        Limit::perMinute(3);
        $internelProduct = InternelProduct::orderByDesc('id')->get();

        return response()->json($internelProduct);

    }

    public function detail($id){
        $product = InternelProduct::find($id);

        return response()->json($product);
    }

    public function add(){
        $internelProduct = InternelProduct::create([
            'internel_id' => request('internel_id'),
            'product_id' => request('product_id'),
            'qty' => request('qty') ,
        ]);

        return response()->json($internelProduct);
    }

    public function edit($id){
        $internelProduct = InternelProduct::where('id',$id)->update([
            'product_id' => request('product_id'),
            'internel_id' => request('internel_id') ,
            'qty' => request('qty') ,
        ]);

        return response()->json($internelProduct);
    }

    public function remove($id){
        $internelProduct = InternelProduct::where('id',$id)->delete();

        return response()->json($internelProduct);
    }

}
