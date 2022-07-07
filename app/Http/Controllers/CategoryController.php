<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }
    
    public function index(){
        Limit::perMinute(3);
        $category = Category::with('getProducts')->orderByDesc('id')->where('user_id',$this->user->id)->get();

        return response()->json($category);

    }

    public function add(){
        $category = Category::create([
            'user_id' => $this->user->id,
            'name' => request('name') 
        ]);

        return response()->json($category);
    }
    public function detail($id){
        $category = Category::where('id',$id)->first();

        return response()->json($category);
    }
    public function edit($id){
        $category = Category::where('id',$id)->update([
            'name' => request('name')
        ]);

        return response()->json($category);
    }
    public function remove($id){
        $category = Category::where('id',$id)->delete();

        return response()->json($category);

    }
}
