<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    protected $user;

    public function __construct(){
        $this->user = User::where('id',1) ->first();
    }

    public function index(Request $request){
        Limit::perMinute(3);
        $product = Product::with('getBrand','getMaterial','getPattern','getCategory','getSeason')->orderByDesc('id')->where('user_id',auth()->id());
        if($request->has('brand')){
            $product->where('brand_id',$request->brand);
        }

        if($request->has('category')){
            $product->where('category_id',$request->category);
        }

        if($request->has('season')){
            $product->where('season_id',$request->season);
        }

        if($request->has('pattern')){
            $product->where('pattern_id',$request->pattern);
        }

        if($request->has('material')){
            $product->where('material_id',$request->material);
        }

        if($request->has('code')){
            $product->where('code','LIKE', '%' . $request->code . '%');
        }

        if($request->has('name')){
            $product->where('name','LIKE', '%' . $request->name  . '%');
        }


        if($request->has('price')){
            if($request->price=='1'){
                $product->where('price','>=',1)->where('price','<=',50);
            }else if($request->price=='2'){
                $product->where('price','>=',50)->where('price','<=',100);
            }else if($request->price=='3'){
                $product->where('price','>=',100)->where('price','<=',200);
            }else if($request->price=='4'){
                $product->where('price','>=',200)->where('price','<=',500);
            }else if($request->price=='5'){
                $product->where('price','>=',500)->where('price','<=',1000);
            }else if($request->price=='6'){
                $product->whphere('price','>=',1000);
            }
        }

        if($request->has('img')){
            if($request->img=='1'){
                $product->where('img','!=',null);
            }else if($request->img=='2'){
                $product->where('img','=',null);
            }
        }

        return response()->json($product->get());

    }

    public function add(){

        $product = Product::create([
            'user_id' => auth()->id(),
            'img' => request('img'),
            'name' => request('name'),
            'price' => request('price'),
            'cors' => request('cors'),
            'code' => request('code'),
            'qty' => request('qty'),
            'content' => request('content'),
            'category_id' => request('category_id'),
            'pattern_id' => request('pattern_id'),
            'material_id' => request('material_id'),
            'brand_id' => request('brand_id'),
            'season_id' => request('season_id'),
        ]);

        return response()->json($product);
    }

    public function detail($id){
        $product = Product::with('getBrand','getMaterial','getPattern','getCategory','getSeason','getProductVariant.getProductVariantValue.getProductVariantStock')->where('id',$id)->first();

        return response()->json($product);
    }

    public function edit($id){
        $product = Product::where('id',$id)->update([
            'name' => request('name'),
            'img' => request('img'),
            'price' => request('price'),
            'code' => request('code'),
            'qty' => request('qty'),
            'cors' => request('cors'),
            'content' => request('content'),
            'category_id' => request('category_id'),
            'pattern_id' => request('pattern_id'),
            'material_id' => request('material_id'),
            'brand_id' => request('brand_id'),
            'season_id' => request('season_id'),
        ]);

        return response()->json($product);
    }

    public function remove($id){
        $product = Product::where('id',$id)->delete();

        return response()->json($product);

    }
}
