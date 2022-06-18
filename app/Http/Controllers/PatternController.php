<?php

namespace App\Http\Controllers;

use App\Models\Pattern;
use App\Models\User;
use Illuminate\Http\Request;

class PatternController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }
    public function index(){
        $pattern = Pattern::with('getProducts')->orderByDesc('id')->where('user_id',$this->user->id)->get();

        return response()->json($pattern);

    }

    public function add(){
        $pattern = Pattern::create([
            'user_id' => $this->user->id,
            'name' => request('name') 
        ]);

        return response()->json($pattern);
    }

    public function detail($id){
        $pattern = Pattern::where('id',$id)->first();

        return response()->json($pattern);
    }
    public function edit($id){
        $pattern = Pattern::where('id',$id)->update([
            'name' => request('name')
        ]);

        return response()->json($pattern);
    }
    public function remove($id){
        $pattern = Pattern::where('id',$id)->delete();

        return response()->json($pattern);

    }
}
