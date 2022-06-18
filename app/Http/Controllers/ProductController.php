<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }
    public function index(){
        $product = Product::with('getBrand','getMaterial','getPattern','getCategory','getSeason')->orderByDesc('id')->where('user_id',$this->user->id)->get();

        return response()->json($product);

    }

    public function add(){
        $product = Product::create([
            'user_id' => $this->user->id,
            'img' => request('img'),
            'name' => request('name'),
            'price' => request('price'),
            'code' => request('code'),
            'qty' => request('qty'),
            'sizes' => request('sizes'),
            'content' => request('content'),
            'packQty' => request('packQty'),
            'category_id' => request('category_id'),
            'pattern_id' => request('pattern_id'),
            'material_id' => request('material_id'),
            'brand_id' => request('brand_id'),
            'season_id' => request('season_id'),
        ]);

        return response()->json($product);
    }

    public function detail($id){
        $product = Product::where('id',$id)->first();

        return response()->json($product);
    }
    public function edit($id){
        $product = Product::where('id',$id)->update([
            'name' => request('name'),
            'img' => request('img'),
            'price' => request('price'),
            'code' => request('code'),
            'qty' => request('qty'),
            'packQty' => request('packQty'),
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