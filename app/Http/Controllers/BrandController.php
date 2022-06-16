<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }
    public function index(){
        $brands = Brand::orderByDesc('id')->where('user_id',$this->user->id)->get();

        return response()->json($brands);

    }
    public function detail($id){
        $brands = Brand::where('id',$id)->first();

        return response()->json($brands);
    }

    public function add(){
        $brand = Brand::create([
            'user_id' => $this->user->id,
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
