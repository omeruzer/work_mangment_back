<?php

namespace App\Http\Controllers;

use App\Models\Departman;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmanController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }
    public function index(){
        $departman = Departman::where('user_id',$this->user->id)->get();

        return response()->json($departman);

    }
    public function add(){
        $departman = Departman::create([
            'user_id' => $this->user->id,
            'name' => request('name') 
        ]);

        return response()->json($departman);
    }
    public function detail($id){
        $departman = Departman::where('id',$id)->first();

        return response()->json($departman);
    }
    public function edit($id){
        $departman = Departman::where('id',$id)->update([
            'name' => request('name')
        ]);

        return response()->json($departman);
    }
    public function remove($id){
        $departman = Departman::where('id',$id)->delete();

        return response()->json($departman);

    }
}
