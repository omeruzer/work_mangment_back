<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\User;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }
    public function index(){
        $material = Material::where('user_id',$this->user->id)->get();

        return response()->json($material);

    }
    public function add(){
        $material = Material::create([
            'user_id' => $this->user->id,
            'name' => request('name') 
        ]);

        return response()->json($material);
    }
    public function detail($id){
        $material = Material::where('id',$id)->first();

        return response()->json($material);
    }
    public function edit($id){
        $material = Material::where('id',$id)->update([
            'name' => request('name')
        ]);

        return response()->json($material);
    }
    public function remove($id){
        $material = Material::where('id',$id)->delete();

        return response()->json($material);

    }
}
