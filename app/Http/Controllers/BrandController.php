<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1) ->first();
    }
    public function index(){
        Limit::perMinute(3);
        $brands = Brand::orderByDesc('id')->where('user_id',auth()->id())->get();

        return response()->json($brands);

    }
    public function detail($id){
        $brands = Brand::where('id',$id)->first();

        return response()->json($brands);
    }

    public function add(){
        $brand = Brand::create([
            'user_id' => auth()->id(),
            'name' => request('name')
        ]);

        return response()->json($brand);
    }


    public function edit($id){
        $brands = Brand::where('id',$id)->update([
            'name' => request('name')
        ]);

        return response()->json($brands);
    }
    public function remove($id){
        $brands = Brand::where('id',$id)->delete();

        return response()->json($brands);

    }
}
